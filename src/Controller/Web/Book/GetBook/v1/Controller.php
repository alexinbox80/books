<?php

namespace App\Controller\Web\Book\GetBook\v1;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[AsController]
class Controller
{
    public function __construct(
        private readonly Manager $manager,
    )
    {
    }

    #[Route(
        path: 'api/v1/books',
        name: 'web_get_books_v1_invoke',
        requirements: ['page' => '\d+', 'perPage' => '\d+'],
        methods: ['GET']
    )]
    public function __invoke(
        #[MapQueryParameter(filter: \FILTER_VALIDATE_INT)] ?int $page = null,
        #[MapQueryParameter(filter: \FILTER_VALIDATE_INT)] ?int $perPage = null
    ): jsonResponse
    {
        return new JsonResponse(['books' => $this->manager->getBooksPaginated($page ?? 0, $perPage ?? 20)]);
    }
}
