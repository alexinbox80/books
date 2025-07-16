<?php

namespace App\Controller\Web\RESTful\Books\GetBookById\v1\Output;

class GotBookByIdDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $authorId,
        public readonly string $firstName,
        public readonly string $LastName,
        public readonly string $title,
        public readonly ?string $description = null,
        public readonly string $createdAt
    ) {
    }
}
