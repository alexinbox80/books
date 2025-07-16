<?php

namespace App\Controller\Web\Author\UpdateAuthor\v1;

use App\Controller\Web\Author\UpdateAuthor\v1\Input\UpdateAuthorDTO;
use App\Domain\Entity\Author;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller
{
    public function __construct(
        private readonly Manager $manager
    ) {
    }

    #[Route(
        path: 'api/v1/author/{id}',
        name: 'web_update_author_by_id_v1_invoke',
        requirements: ['id' => '\d+'],
        methods: ['PATCH']
    )]
    public function __invoke(
        #[MapEntity(id: 'id')] Author $author,
        #[MapRequestPayload] UpdateAuthorDTO $updateAuthorDTO
    ): jsonResponse
    {
        return new JsonResponse(['author' => $this->manager->updateAuthor($author, $updateAuthorDTO)]);
    }
}
