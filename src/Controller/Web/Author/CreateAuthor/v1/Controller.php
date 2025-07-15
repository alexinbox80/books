<?php

namespace App\Controller\Web\Author\CreateAuthor\v1;

use App\Controller\Web\Author\CreateAuthor\v1\Input\CreateAuthorDTO;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[AsController]
class Controller
{
    public function __construct(
        private readonly Manager $manager,
    ) {
    }

    #[Route(path: 'api/v1/author', name: 'web_post_author_v1_invoke', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CreateAuthorDTO $createAuthorDTO): JsonResponse
    {
        return new JsonResponse(['author' => $this->manager->create($createAuthorDTO)]);
    }
}
