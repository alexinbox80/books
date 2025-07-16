<?php

namespace App\Controller\Web\Book\CreateBook\v1;

use App\Controller\Web\Book\CreateBook\v1\Input\CreateBookDTO;
use App\Controller\Web\Book\CreateBook\v1\Output\CreatedBookDTO;
use App\Domain\Model\CreateBookModel;
use App\Domain\Service\BookService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<CreateBookModel> */
        private readonly ModelFactory $modelFactory,
        private readonly BookService $bookService,
    ) {
    }

    public function create(CreateBookDTO $createBookDTO): CreatedBookDTO
    {
        $createBookModel = $this->modelFactory->makeModel(
            CreateBookModel::class,
            $createBookDTO->authorId,
            $createBookDTO->title,
            $createBookDTO->description
        );

        $book = $this->bookService->create($createBookModel);

        return new CreatedBookDTO(
            $book->getId(),
            $book->getAuthor()->getId(),
            $book->getTitle(),
            $book->getDescription(),
            $book->getCreatedAt()->format('Y-m-d H:i:s'),
            $book->getUpdatedAt()->format('Y-m-d H:i:s'),
        );
    }
}
