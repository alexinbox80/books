<?php

namespace App\Controller\Web\RESTful\Books\GetBookById\v1;

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
        path: '/api/v1/books/{id}',
        name: 'web_get_book_by_id_v1_invoke',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
    public function __invoke(
        int $id
    ): jsonResponse
    {
        return new JsonResponse(['books' => $this->manager->find($id)]);
    }
}
