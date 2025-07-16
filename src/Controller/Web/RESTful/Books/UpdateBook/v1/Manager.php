<?php

namespace App\Controller\Web\RESTful\Books\UpdateBook\v1;

use App\Controller\Web\RESTful\Books\UpdateBook\v1\Input\UpdateBookDTO;
use App\Controller\Web\RESTful\Books\UpdateBook\v1\Output\UpdatedBookDTO;
use App\Domain\Model\UpdateBookModel;
use App\Domain\Service\BookService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<UpdateBookModel> */
        private readonly ModelFactory $modelFactory,
        private readonly BookService $bookService
    ) {
    }

    public function updateBook(UpdateBookDTO $updateBookDTO): UpdatedBookDTO
    {
        $book = $this->bookService->findById($updateBookDTO->id);

        $updateBookModel = $this->modelFactory->makeModel(
            UpdateBookModel::class,
            $updateBookDTO->authorId,
            $updateBookDTO->title,
            $updateBookDTO->description
        );

        $book = $this->bookService->update($book, $updateBookModel);

        return new UpdatedBookDTO(
            $book->getId(),
            $book->getAuthor()->getId(),
            $book->getAuthor()->getFirstName(),
            $book->getAuthor()->getLastName(),
            $book->getTitle(),
            $book->getDescription(),
            $book->getCreatedAt()->format('Y-m-d H:i:s'),
            $book->getUpdatedAt()->format('Y-m-d H:i:s')
        );
    }
}
