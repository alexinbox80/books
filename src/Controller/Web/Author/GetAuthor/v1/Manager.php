<?php

namespace App\Controller\Web\Author\GetAuthor\v1;

use App\Controller\Web\Author\GetAuthor\v1\Output\AuthorDTO;
use App\Domain\Model\AuthorModel;
use App\Domain\Service\AuthorService;

class Manager
{
    public function __construct(
        private readonly AuthorService $authorService
    )
    {
    }

    /**
     * @return AuthorModel[]
     */
    public function getAuthorsPaginated(int $page, int $perPage): array
    {
        return array_map(
            static fn (AuthorModel $authorModel) => new AuthorDTO(
                $authorModel->id,
                $authorModel->firstName,
                $authorModel->lastName,
                $authorModel->description,
                $authorModel->createdAt->format('Y-m-d H:i:s'),
            ),
            $this->authorService->getAuthorsPaginated($page, $perPage)
        );
    }
}
