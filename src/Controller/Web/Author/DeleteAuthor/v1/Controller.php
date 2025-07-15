<?php

namespace App\Controller\Web\Author\DeleteAuthor\v1;

use App\Controller\Web\Author\DeleteAuthor\v1\Output\DeletedAuthorDTO;
use App\Domain\Entity\Author;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class Controller
{
    public function __construct(
        private readonly Manager $manager
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    #[Route(
        path: 'api/v1/author/{id}',
        name: 'web_delete_author_by_id_v1_invoke',
        requirements: ['id' => '\d+'],
        methods: ['DELETE']
    )]
    public function __invoke(#[MapEntity(id: 'id')] Author $author): JsonResponse
    {
        return new JsonResponse(['author' => $this->manager->deleteAuthor($author)]);
    }
}
