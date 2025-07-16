<?php

namespace App\Controller\Web\Book\UpdateBook\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateBookDTO
{
    public function __construct(
        #[Assert\Type('integer')]
        #[Assert\Positive]
        public readonly int $authorId,
        #[Assert\NotBlank]
        #[Assert\Length(min:2)]
        #[Assert\Length(max:64)]
        public readonly string $title,
        public readonly ?string $description
    ) {
    }
}
