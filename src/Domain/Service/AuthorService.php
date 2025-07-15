<?php

namespace App\Domain\Service;

use App\Domain\Entity\Author;
use App\Domain\Model\AuthorModel;
use App\Domain\Model\CreateAuthorModel;
use App\Domain\Model\UpdateAuthorModel;
use App\Infrastructure\Repository\AuthorRepository;

class AuthorService
{

    public function __construct(
        private readonly AuthorRepository $authorRepository
    )
    {
    }

    /**
     * @param int $authorId
     * @return ?Author
     */
    public function find(int $authorId): ?Author
    {
        return $this->authorRepository->find($authorId);
    }

    /**
     * @return Author[]
     */
    public function findAll(): array
    {
        return $this->authorRepository->findAll();
    }

    /**
     * @param string $firstName
     * @return Author[]
     */
    public function findAuthorByFirstName(string $firstName): array
    {
        return $this->authorRepository->findAuthorByFirstName($firstName);
    }

    /**
     * @param string $lastName
     * @return Author[]
     */
    public function findAuthorByLastName(string $lastName): array
    {
        return $this->authorRepository->findAuthorByLastName($lastName);
    }

    /**
     * @return AuthorModel[]
     */
    public function getAuthorsPaginated(int $page, int $perPage): array
    {
        return array_map(
            static fn (Author $author): AuthorModel => new AuthorModel(
                $author->getId(),
                $author->getFirstName(),
                $author->getLastName(),
                $author->getDescription(),
                $author->getCreatedAt(),
            ),
            $this->authorRepository->getAuthorsPaginated($page, $perPage)
        );
    }

    /**
     * @param int $authorId
     * @param string $firstName
     * @return Author|null
     */
    public function updateFirstName(int $authorId, string $firstName): ?Author
    {
        $author = $this->authorRepository->find($authorId);
        if (!($author instanceof Author)) {
            return null;
        }
        $this->authorRepository->updateAuthor($author, $firstName, $author->getLastName());

        return $author;
    }

    /**
     * @param int $authorId
     * @param string $lastName
     * @return Author|null
     */
    public function updateLastName(int $authorId, string $lastName): ?Author
    {
        $author = $this->authorRepository->find($authorId);
        if (!($author instanceof Author)) {
            return null;
        }
        $this->authorRepository->updateAuthor($author, $author->getFirstName(), $lastName);

        return $author;
    }

    /**
     * @param int $authorId
     * @param string $description
     * @return Author|null
     */
    public function updateDescription(int $authorId, string $description): ?Author
    {
        $author = $this->authorRepository->find($authorId);
        if (!($author instanceof Author)) {
            return null;
        }
        $this->authorRepository->updateAuthor($author, $author->getFirstName(), $author->getLastName(), $description);

        return $author;
    }

    /**
     * @param CreateAuthorModel $createAuthorModel
     * @return Author
     */
    public function create(CreateAuthorModel $createAuthorModel): Author
    {
        $author = new Author(
            $createAuthorModel->firstName,
            $createAuthorModel->lastName,
            $createAuthorModel->description
        );

        $this->authorRepository->create($author);

        return $author;
    }

    /**
     * @param Author $author
     * @param UpdateAuthorModel $updateAuthorModel
     * @return Author
     */
    public function update(Author $author, UpdateAuthorModel $updateAuthorModel): Author
    {
        $author->changeFields(
            $updateAuthorModel->firstName,
            $updateAuthorModel->lastName,
            $updateAuthorModel->description,
        );

        $this->authorRepository->update();

        return $author;
    }

    /**
     * @param int $authorId
     * @return void
     */
    public function removeById(int $authorId): void
    {
        $author = $this->authorRepository->find($authorId);
        if ($author instanceof Author) {
            $this->authorRepository->remove($author);
        }
    }

    /**
     * @param Author $author
     * @return void
     */
    public function removeAuthor(Author $author): void
    {
        $this->authorRepository->remove($author);
    }

}
