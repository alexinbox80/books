<?php

namespace App\Controller\Web\Author\DeleteAuthor\v1;

use App\Controller\Web\Author\DeleteAuthor\v1\Output\DeletedAuthorDTO;
use App\Domain\Entity\Author;
use App\Domain\Service\AuthorService;
use Psr\Cache\InvalidArgumentException;

class Manager
{
    public function __construct(
        private readonly AuthorService $authorService
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function deleteAuthor(Author $author): DeletedAuthorDTO
    {
        $this->authorService->removeAuthor($author);
        return new DeletedAuthorDTO();
    }
}
