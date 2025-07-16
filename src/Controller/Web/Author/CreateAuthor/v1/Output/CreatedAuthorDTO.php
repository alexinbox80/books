<?php

namespace App\Controller\Web\Author\CreateAuthor\v1\Output;

class CreatedAuthorDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly ?string $description,
        public readonly string $createdAt,
        public readonly string $updatedAt,
    ) {
    }
}
