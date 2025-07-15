<?php

namespace App\Controller\Web\Book\CreateBook\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

class CreateBookDTO
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
