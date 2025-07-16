<?php

namespace App\Controller\Web\Book\DeleteBook\v1\Output;

use App\Controller\Common\ResultTrait;
use App\Controller\DTO\OutputDTOInterface;
use Symfony\Component\HttpFoundation\Response;

class DeletedBookDTO implements OutputDTOInterface
{
    use ResultTrait;

    public function __construct(
    ) {
        $this->setSuccess(true);
        $this->setCode(Response::HTTP_OK);
    }
}
