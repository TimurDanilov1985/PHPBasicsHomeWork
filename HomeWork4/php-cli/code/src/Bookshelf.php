<?php

namespace Root\Code;

class Bookshelf
{
    private array $books = [];

    public function addBook(Book $book)
    {
        array_push($this->books, $book);
    }

    public function showBooks()
    {
        foreach ($this->books as $book) {
            echo $book->description();
        }
    }
}
