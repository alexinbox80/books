<?php

namespace App\Controller\Web\RESTful\Books\UpdateBook\v1\Output;

class UpdatedBookDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $authorId,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $title,
        public readonly ?string $description,
        public readonly string $createdAt,
        public readonly string $updatedAt,
    ) {
    }
}
