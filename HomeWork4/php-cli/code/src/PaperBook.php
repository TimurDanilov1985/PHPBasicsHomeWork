<?php

namespace Root\Code;

class PaperBook extends Book
{
    private string $library;

    public function __construct(string $title, string $author, int $year, string $library)
    {
        parent::__construct($title, $author, $year);
        $this->library = $library;
    }

    public function description(): string {
        return parent::description()."Библиотека: ". $this->library."\n";
    }

    public function gettingBook(): string
    {
        return "Книга выдана\n";
    }

    public function returnBook(): string
    {
        return "Книга возвращена библиотеку\n";
    }
}
