<?php

namespace App\Controller\Web\Book\GetBook\v1\Output;

class BookDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $authorId,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $title,
        public readonly ?string $description = null,
        public readonly string $createdAt
    ) {
    }
}
