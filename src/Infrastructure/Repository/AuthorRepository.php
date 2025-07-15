<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Author;

class AuthorRepository extends AbstractRepository
{
    /**
     * @return Author[]
     */
    public function getAuthors(int $page, int $perPage): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('a')
            ->from(Author::class, 'a')
            ->orderBy('a.id', 'DESC')
            ->setFirstResult($perPage * $page)
            ->setMaxResults($perPage);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $authorId
     * @return Author|null
     */
    public function find(int $authorId): ?Author
    {
        $repository = $this->entityManager->getRepository(Author::class);
        /** @var Author|null $author */
        $author = $repository->find($authorId);

        return $author;
    }

    /**
     * @return Author[]
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository(Author::class)->findAll();
    }

    /**
     * @param string $firstName
     * @return Author[]
     */
    public function findAuthorByFirstName(string $firstName): array
    {
        return $this->entityManager->getRepository(Author::class)->findBy(['first_name' => $firstName]);
    }

    /**
     * @param string $lastName
     * @return Author[]
     */
    public function findAuthorByLastName(string $lastName): array
    {
        return $this->entityManager->getRepository(Author::class)->findBy(['last_name' => $lastName]);
    }

    /**
     * @param Author $author
     * @param string $firstName
     * @param string $lastName
     * @param ?string $description
     * @return void
     */
    public function updateAuthor(Author $author, string $firstName, string $lastName, ?string $description = null): void
    {
        $author->changeFields($firstName, $lastName, $description);
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
     * @param Author $author
     * @return int
     */
    public function create(Author $author): int
    {
        return $this->store($author);
    }

    /**
     * @param Author $author
     * @return void
     */
    public function remove(Author $author): void
    {
        $author->setDeletedAt();
        $this->flush();
    }
}
