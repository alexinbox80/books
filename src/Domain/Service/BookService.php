<?php

namespace App\Domain\Service;

use App\Domain\Entity\Book;
use App\Domain\Model\CreateBookModel;
use App\Infrastructure\Repository\AuthorRepository;
use App\Infrastructure\Repository\BookRepository;

class BookService
{
    public function __construct(
        private readonly AuthorRepository $authorRepository,
        private readonly BookRepository $bookRepository
    )
    {
    }

    /**
     * @param int $bookId
     * @return ?Book
     */
    public function find(int $bookId): ?Book
    {
        return $this->bookRepository->find($bookId);
    }

    /**
     * @return Book[]
     */
    public function findAll(): array
    {
        return $this->bookRepository->findAll();
    }

    /**
     * @param string $title
     * @return Book[]
     */
    public function findBookByTitle(string $title): array
    {
        return $this->bookRepository->findBookByTitle($title);
    }

    /**
     * @return Book[]
     */
    public function getBooksPaginated(int $page, int $perPage): array
    {
        return $this->bookRepository->getBooksPaginated($page, $perPage);
    }

    /**
     * @param int $bookId
     * @param string $title
     * @return Book|null
     */
    public function updateTitle(int $bookId, string $title): ?Book
    {
        $book = $this->bookRepository->find($bookId);
        if (!($book instanceof Book)) {
            return null;
        }
        $this->bookRepository->updateBook($book, $title);

        return $book;
    }

    /**
     * @param int $bookId
     * @param string $description
     * @return Book|null
     */
    public function updateDescription(int $bookId, string $description): ?Book
    {
        $book = $this->bookRepository->find($bookId);
        if (!($book instanceof Book)) {
            return null;
        }
        $this->bookRepository->updateBook($book, $book->getTitle(), $description);

        return $book;
    }

    /**
     * @param CreateBookModel $createBookModel
     * @return Book
     */
    public function create(CreateBookModel $createBookModel): Book
    {
        $author = $this->authorRepository->find($createBookModel->authorId);

        $book = new Book(
            $author,
            $createBookModel->title,
            $createBookModel->description
        );

        $this->bookRepository->create($book);

        return $book;
    }

//    /**
//     * @param Book $book
//     * @param UpdateBookModel $updateBookModel
//     * @return Book
//     */
//    public function update(Book $book, UpdateBookModel $updateBookModel): Book
//    {
//        $book->changeFields(
//            $updateBookModel->title,
//            $updateBookModel->description,
//        );
//
//        $this->bookRepository->update();
//
//        return $book;
//    }

    /**
     * @param int $bookId
     * @return void
     */
    public function removeById(int $bookId): void
    {
        $book = $this->bookRepository->find($bookId);
        if ($book instanceof Book) {
            $this->bookRepository->remove($book);
        }
    }

    /**
     * @param Book $book
     * @return void
     */
    public function removeBook(Book $book): void
    {
        $this->bookRepository->remove($book);
    }
}
