<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions/func_constant.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$host = RABBITMQ_HOST;
$port = RABBITMQ_PORT;
$username = RABBITMQ_USERNAME;
$password = RABBITMQ_PASSWORD;
$vhost = '/';
$queueName = 'notifications';

echo "[*] Listening to RabbitMQ queue: $queueName\n";

$connection = new AMQPStreamConnection($host, $port, $username, $password, $vhost);
$channel = $connection->channel();
$channel->queue_declare($queueName, false, true, false, false);

$callback = function ($msg) {
    echo "[x] Received message: " . $msg->body . "\n";

    $data = json_decode($msg->body, true);

    if ($data['type'] === 'email') {
        $email = $data['email'];
        $subject = "Your Vitals Record";
        $message = $data['message'];
        $headers = "From: bsystemscollateraldept2021@gmail.com";

        // Fake send (replace this with real PHPMailer if needed)
        mail($email, $subject, $message, $headers);

        echo "[✓] Email sent to {$email}\n";
    }

    $msg->ack(); // Acknowledge message
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume($queueName, '', false, false, false, false, $callback);

// Keep the worker alive
while ($channel->is_consuming()) {
    $channel->wait();
}
