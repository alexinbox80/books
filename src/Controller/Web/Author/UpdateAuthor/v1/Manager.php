<?php

namespace App\Controller\Web\Author\UpdateAuthor\v1;

use App\Controller\Web\Author\UpdateAuthor\v1\Input\UpdateAuthorDTO;
use App\Controller\Web\Author\UpdateAuthor\v1\Output\UpdatedAuthorDTO;
use App\Domain\Entity\Author;
use App\Domain\Model\UpdateAuthorModel;
use App\Domain\Service\AuthorService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<UpdateAuthorModel> */
        private readonly ModelFactory $modelFactory,
        private readonly AuthorService $authorService
    ) {
    }

    public function updateAuthor(Author $author, UpdateAuthorDTO $updateAuthorDTO): UpdatedAuthorDTO
    {
        $updateAuthorModel = $this->modelFactory->makeModel(
            UpdateAuthorModel::class,
            $updateAuthorDTO->lastName,
            $updateAuthorDTO->firstName,
            $updateAuthorDTO->description
        );

        $author = $this->authorService->update($author, $updateAuthorModel);

        return new UpdatedAuthorDTO(
            $author->getId(),
            $author->getFirstName(),
            $author->getLastName(),
            $author->getDescription(),
            $author->getCreatedAt()->format('Y-m-d H:i:s'),
            $author->getUpdatedAt()->format('Y-m-d H:i:s')
        );
    }
}
