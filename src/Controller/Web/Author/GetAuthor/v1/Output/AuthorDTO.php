<?php

namespace App\Controller\Web\Author\GetAuthor\v1\Output;

class AuthorDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly ?string $description = null,
        public readonly string $createdAt
    ) {
    }
}
