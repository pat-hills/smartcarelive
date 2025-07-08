<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/class.Queue.php';
require_once __DIR__ . '/functions/func_constant.php';

 

// --- RabbitMQ Check ---
use PhpAmqpLib\Connection\AMQPStreamConnection;

$rabbitStatus = 'disconnected';
$queueSize = 0;
$queueName = 'notifications';

try {
    $connection = new AMQPStreamConnection(
        RABBITMQ_HOST,
        RABBITMQ_PORT,
        RABBITMQ_USERNAME,
        RABBITMQ_PASSWORD,
        '/'
    );

    $channel = $connection->channel();
    list($queue, $messageCount, $consumerCount) = $channel->queue_declare($queueName, true);
    
    $rabbitStatus = 'connected';
    $queueSize = $messageCount;

    $channel->close();
    $connection->close();
} catch (Exception $e) {
    $rabbitStatus = 'error: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>System Diagnostics</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .status { padding: 10px; border-radius: 5px; margin-bottom: 10px; }
        .ok { background-color: #e0f7e9; color: #2e7d32; }
        .fail { background-color: #fdecea; color: #c62828; }
    </style>
</head>
<body>
    <h1>🛠 System Diagnostics</h1>

    <div class="status <?= $memResult === 'working' ? 'ok' : 'fail' ?>">
        <strong>Memcached:</strong>
        <?= $memResult === 'working' ? 'Connected and operational ✅' : 'Connection failed ❌' ?>
    </div>

    <div class="status <?= $rabbitStatus === 'connected' ? 'ok' : 'fail' ?>">
        <strong>RabbitMQ:</strong>
        <?= $rabbitStatus === 'connected' ? 'Connected ✅' : 'Error: ' . htmlspecialchars($rabbitStatus) ?>
    </div>

    <?php if ($rabbitStatus === 'connected'): ?>
    <div class="status ok">
        <strong>Queue "<?= $queueName ?>":</strong>
        <?= $queueSize ?> message(s) available
    </div>
    <?php endif; ?>

</body>
</html>
