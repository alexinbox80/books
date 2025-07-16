<?php

namespace App\Controller\Web\RESTful\Books\DeleteBook\v1;

use App\Domain\Entity\Book;
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
        path: 'api/v1/books/{id}',
        name: 'web_delete_books_by_id_v1_invoke',
        requirements: ['id' => '\d+'],
        methods: ['DELETE']
    )]
    public function __invoke(#[MapEntity(id: 'id')] Book $book): JsonResponse
    {
        return new JsonResponse(['book' => $this->manager->deleteBook($book)]);
    }
}
