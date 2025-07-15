<?php

namespace App\Controller\Web\Book\UpdateBook\v1;

use App\Controller\Web\Book\UpdateBook\v1\Input\UpdateBookDTO;
use App\Domain\Entity\Book;
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
        path: 'api/v1/book/{id}',
        name: 'web_update_book_by_id_v1_invoke',
        requirements: ['id' => '\d+'],
        methods: ['PATCH']
    )]
    public function __invoke(
        #[MapEntity(id: 'id')] Book $book,
        #[MapRequestPayload] UpdateBookDTO $updateBookDTO
    ): jsonResponse
    {
        return new JsonResponse(['book' => $this->manager->updateBook($book, $updateBookDTO)]);
    }
}
