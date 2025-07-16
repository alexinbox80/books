<?php

namespace App\Domain\Model;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateBookModel
{
    public function __construct(
        #[Assert\Type('integer')]
        #[Assert\Positive]
        public readonly int $authorId,
        #[Assert\NotBlank]
        public readonly string $title,
        public readonly ?string $description
    ) {
    }
}
