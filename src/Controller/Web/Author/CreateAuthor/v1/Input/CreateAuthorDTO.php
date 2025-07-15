<?php

namespace App\Controller\Web\Author\CreateAuthor\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAuthorDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $firstName,
        #[Assert\NotBlank]
        public readonly string $lastName,
        public readonly ?string $description
    ) {
    }
}
