<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue {
    private $connection;
    private $channel;

    public function __construct($host, $port, $user, $pass, $vhost = '/') {
        $this->connection = new AMQPStreamConnection($host, $port, $user, $pass, $vhost);
        $this->channel = $this->connection->channel();
    }

    public function publish($queueName, $data) {
        $this->channel->queue_declare($queueName, false, true, false, false);
        $msg = new AMQPMessage(json_encode($data), ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $this->channel->basic_publish($msg, '', $queueName);
    }

    public function close() {
        $this->channel->close();
        $this->connection->close();
    }
}
?>
