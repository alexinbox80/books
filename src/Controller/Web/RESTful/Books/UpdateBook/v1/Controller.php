<?php

namespace App\Controller\Web\RESTful\Books\UpdateBook\v1;

use App\Controller\Web\RESTful\Books\UpdateBook\v1\Input\UpdateBookDTO;
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
        path: 'api/v1/books/update',
        name: 'web_update_books_v1_invoke',
        methods: ['POST']
    )]
    public function __invoke(
        #[MapRequestPayload] UpdateBookDTO $updateBookDTO
    ): jsonResponse
    {
        return new JsonResponse(['book' => $this->manager->updateBook($updateBookDTO)]);
    }
}
