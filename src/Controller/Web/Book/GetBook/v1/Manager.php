<?php

namespace App\Controller\Web\Book\GetBook\v1;

use App\Controller\Web\Book\GetBook\v1\Output\BookDTO;
use App\Domain\Model\BookModel;
use App\Domain\Service\BookService;

class Manager
{
    public function __construct(
        private readonly BookService $bookService
    )
    {
    }

    /**
     * @return bookModel[]
     */
    public function getBooksPaginated(int $page, int $perPage): array
    {
        return array_map(
            static fn (BookModel $bookModel) => new BookDTO(
                $bookModel->id,
                $bookModel->authorId,
                $bookModel->title,
                $bookModel->description,
                $bookModel->createdAt->format('Y-m-d H:i:s'),
            ),
            $this->bookService->getBooksPaginated($page, $perPage)
        );
    }
}
