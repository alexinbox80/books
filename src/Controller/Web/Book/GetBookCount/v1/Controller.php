<?php

namespace App\Controller\Web\Book\GetBookCount\v1;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller
{
    public function __construct(
        private readonly Manager $manager,
    )
    {
    }

    #[Route(
        path: 'api/v1/authors/count',
        name: 'web_get_authors_count_v1_invoke',
        methods: ['GET']
    )]
    public function __invoke(): jsonResponse
    {
        return new JsonResponse(['authors' => $this->manager->getBooksCount()]);
    }
}
