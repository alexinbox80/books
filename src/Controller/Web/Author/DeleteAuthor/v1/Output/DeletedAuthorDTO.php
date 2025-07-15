<?php

namespace App\Controller\Web\Author\DeleteAuthor\v1\Output;

use App\Controller\Common\ResultTrait;
use App\Controller\DTO\OutputDTOInterface;
use Symfony\Component\HttpFoundation\Response;

class DeletedAuthorDTO implements OutputDTOInterface
{
    use ResultTrait;

    public function __construct(
    ) {
        $this->setSuccess(true);
        $this->setCode(Response::HTTP_OK);
    }
}
