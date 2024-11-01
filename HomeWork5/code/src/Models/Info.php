<?php

namespace Geekbrains\Application1\Models;

class Info {

    private string $server;
    private string $phpVersion;
    private string $browser;
    public function __construct() {
        $this->server = $_SERVER['SERVER_SOFTWARE'];
        $this->phpVersion = phpversion();
        $this->browser = $_SERVER['HTTP_USER_AGENT'];
    }

    public function getServer() : string {
        return $this->server;
    }

    public function getPhpVersion() : string {
        return $this->phpVersion;
    }
    public function getBrowser() : string {
        return $this->browser;
    }

}