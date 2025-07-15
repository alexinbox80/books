<?php

namespace App\Controller\Web\Author\UpdateAuthor\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateAuthorDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min:2)]
        #[Assert\Length(max:64)]
        public readonly string $firstName,
        #[Assert\NotBlank]
        #[Assert\Length(min:2)]
        #[Assert\Length(max:64)]
        public readonly string $lastName,
        public readonly ?string $description
    ) {
    }
}
