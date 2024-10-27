<?php

namespace Root\Code;

class Room {

    private array $bookshelf;

    public function __construct(array $bookshelf) {
        $this->bookshelf = $bookshelf;
    }
}