<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

class NotificationServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

$server = new \Ratchet\App('localhost', 8080);
$server->route('/notificaciones', new NotificationServer, ['*']);
$server->run();
