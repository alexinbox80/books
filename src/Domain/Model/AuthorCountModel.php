<?php

namespace App\Domain\Model;

use DateTime;

class AuthorCountModel
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $count
    ) {
    }
}
