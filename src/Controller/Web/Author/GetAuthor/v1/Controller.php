<?php

namespace App\Controller\Web\Author\GetAuthor\v1;

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
        path: 'api/v1/authors',
        name: 'web_get_authors_v1_invoke',
        requirements: ['page' => '\d+', 'perPage' => '\d+'],
        methods: ['GET']
    )]
    public function __invoke(
        #[MapQueryParameter(filter: \FILTER_VALIDATE_INT)] ?int $page = null,
        #[MapQueryParameter(filter: \FILTER_VALIDATE_INT)] ?int $perPage = null
    ): jsonResponse
    {
        return new JsonResponse(['authors' => $this->manager->getAuthorsPaginated($page ?? 0, $perPage ?? 20)]);
    }
}
