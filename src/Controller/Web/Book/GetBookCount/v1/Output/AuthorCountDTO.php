<?php

namespace App\Controller\Web\Book\GetBookCount\v1\Output;

class AuthorCountDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $count
    ) {
    }
}
