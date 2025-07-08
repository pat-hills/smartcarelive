<?php
require_once __DIR__ . '../functions/func_constant.php';

class Cache {
    private $memcached;

    public function __construct($host = MEMCACHE_HOST, $port = MEMCACHE_PORT) {
        $this->memcached = new Memcached();
        $this->memcached->addServer($host, $port);
    }

    public function set($key, $value, $ttl = 300) {
        return $this->memcached->set($key, $value, $ttl);
    }

    public function get($key) {
        return $this->memcached->get($key);
    }

    public function delete($key) {
        return $this->memcached->delete($key);
    }

    public function clear() {
        return $this->memcached->flush();
    }
}
?>
