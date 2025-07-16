<?php

namespace App\Controller\Web\Book\DeleteBook\v1;

use App\Controller\Web\Book\DeleteBook\v1\Output\DeletedBookDTO;
use App\Domain\Entity\Book;
use App\Domain\Service\BookService;
use Psr\Cache\InvalidArgumentException;

class Manager
{
    public function __construct(
        private readonly BookService $bookService
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function deleteBook(Book $book): DeletedBookDTO
    {
        $this->bookService->removeBook($book);
        return new DeletedBookDTO();
    }
}
