<?php

namespace App\Controller\Web\Book\CreateBook\v1;

use App\Controller\Web\Book\CreateBook\v1\Input\CreateBookDTO;
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

    #[Route(path: 'api/v1/book', name: 'web_post_book_v1_invoke', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CreateBookDTO $createBookDTO): JsonResponse
    {
        return new JsonResponse(['book' => $this->manager->create($createBookDTO)]);
    }
}
