<?php

namespace App\Controller\Web\RESTful\Books\GetBookById\v1;

use App\Controller\DTO\EmptyDTO;
use App\Controller\Web\RESTful\Books\GetBookById\v1\Output\GotBookByIdDTO;
use App\Domain\Service\BookService;

class Manager
{
    public function __construct(
        private readonly BookService $bookService
    )
    {
    }

    /**
     * @param int $bookId
     * @return GotBookByIdDTO|EmptyDTO
     */
    public function find(int $bookId): GotBookByIdDTO|EmptyDTO
    {
        $bookModel = $this->bookService->find($bookId);

        if (!is_null($bookModel)) {
            return new GotBookByIdDTO(
                $bookModel->id,
                $bookModel->authorId,
                $bookModel->firstName,
                $bookModel->lastName,
                $bookModel->title,
                $bookModel->description,
                $bookModel->createdAt->format('Y-m-d H:i:s'),
            );
        } else {
            return new EmptyDTO();
        }
    }
}
