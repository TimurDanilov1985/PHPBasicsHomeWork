<?php

namespace Root\Code;

abstract class Book {
    protected string $title;
    protected string $author;
    protected int $year;

    public function __construct(string $title, string $author, int $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    public function description(): string {
        return "Название: ".$this->title."\n"."Автор: ".$this->author."\n"."Год издания: ".$this->year."\n";
    }
}