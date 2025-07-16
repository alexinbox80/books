<?php

namespace App\Controller\Web\Book\GetBookCount\v1;

use App\Controller\Web\Book\GetBookCount\v1\Output\AuthorCountDTO;
use App\Domain\Model\AuthorCountModel;
use App\Domain\Service\BookService;

class Manager
{
    public function __construct(
        private readonly BookService $bookService
    )
    {
    }

    /**
     * @return AuthorCountDTO[]
     */
    public function getBooksCount(): array
    {
        return array_map(
            static fn (AuthorCountModel $authorCountModel) => new AuthorCountDTO(
                $authorCountModel->id,
                $authorCountModel->firstName,
                $authorCountModel->lastName,
                $authorCountModel->count
            ),
            $this->bookService->getBooksCount()
        );
    }
}
