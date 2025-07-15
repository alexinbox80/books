<?php

namespace App\Domain\Model;

use DateTime;

class BookModel
{
    public function __construct(
        public readonly int $id,
        public readonly int $authorId,
        public readonly string $title,
        public readonly ?string $description,
        public readonly DateTime $createdAt,
    ) {
    }
}
