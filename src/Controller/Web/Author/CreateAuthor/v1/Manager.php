<?php

namespace App\Controller\Web\Author\CreateAuthor\v1;

use App\Controller\Web\Author\CreateAuthor\v1\Input\CreateAuthorDTO;
use App\Controller\Web\Author\CreateAuthor\v1\Output\CreatedAuthorDTO;
use App\Domain\Model\CreateAuthorModel;
use App\Domain\Service\AuthorService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<CreateAuthorModel> */
        private readonly ModelFactory $modelFactory,
        private readonly AuthorService $authorService,
    ) {
    }

    public function create(CreateAuthorDTO $createAuthorDTO): CreatedAuthorDTO
    {
        $createAuthorModel = $this->modelFactory->makeModel(
            CreateAuthorModel::class,
            $createAuthorDTO->firstName,
            $createAuthorDTO->lastName,
            $createAuthorDTO->description
        );

        $author = $this->authorService->create($createAuthorModel);

        return new CreatedAuthorDTO(
            $author->getId(),
            $author->getFirstName(),
            $author->getLastName(),
            $author->getDescription(),
            $author->getCreatedAt()->format('Y-m-d H:i:s'),
            $author->getUpdatedAt()->format('Y-m-d H:i:s'),
        );
    }
}
