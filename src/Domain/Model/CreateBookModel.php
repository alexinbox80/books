<?php

namespace App\Domain\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateBookModel
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly int $authorId,
        #[Assert\NotBlank]
        public readonly string $title,
        public readonly ?string $description
    ) {
    }
}
