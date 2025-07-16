<?php

namespace App\Domain\Model;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAuthorModel
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
