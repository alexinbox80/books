<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Book;

class BookRepository extends AbstractRepository
{
    /**
     * @return Book[]
     */
    public function getBooksPaginated(int $page, int $perPage): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('b')
            ->from(Book::class, 'b')
            ->orderBy('b.id', 'DESC')
            ->setFirstResult($perPage * $page)
            ->setMaxResults($perPage);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return Book[]
     */
    public function getBooksCount(): array
    {
        $dql = "SELECT a.id, a.firstName, a.lastName, COUNT(a.id) as count FROM App\Domain\Entity\Book b
                  INNER JOIN b.author a
                  GROUP BY a.id
                  ORDER BY count DESC";
        $em = $this->entityManager;

        $query = $em->createQuery($dql);
        return $query->getResult();
    }

    /**
     * @param int $bookId
     * @return Book|null
     */
    public function find(int $bookId): ?Book
    {
        $repository = $this->entityManager->getRepository(Book::class);
        /** @var Book|null $book */
        $book = $repository->find($bookId);

        return $book;
    }

    /**
     * @return Book[]
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository(Book::class)->findAll();
    }

    /**
     * @param string $title
     * @return Book[]
     */
    public function findBookByTitle(string $title): array
    {
        return $this->entityManager->getRepository(Book::class)->findBy(['title' => $title]);
    }

    /**
     * @param Book $book
     * @param string $title
     * @param ?string $description
     * @return void
     */
    public function updateBook(Book $book, string $title, ?string $description = null): void
    {
        $book->changeFields($title, $description);
        $this->flush();
    }

    /**
     * @return void
     */
    public function update(): void
    {
        $this->flush();
    }

    /**
     * @param Book $book
     * @return int
     */
    public function create(Book $book): int
    {
        return $this->store($book);
    }

    /**
     * @param Book $book
     * @return void
     */
    public function remove(Book $book): void
    {
        $book->setDeletedAt();
        $this->flush();
    }
}
