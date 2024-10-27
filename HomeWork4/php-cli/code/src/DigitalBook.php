<?php

namespace Root\Code;

class DigitalBook extends Book
{
    private string $url;

    public function __construct(string $title, string $author, int $year, string $url)
    {
        parent::__construct($title, $author, $year);
        $this->url = $url;
    }

    public function description(): string {
        return parent::description()."Библиотека: ". $this->url."\n";
    }

    public function getBook(): string
    {
        return "Книга скачена\n";
    }
}