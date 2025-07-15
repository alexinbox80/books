<?php

namespace App\Domain\Entity\Interface;

use DateTime;

interface SoftDeletableInterface
{
    public function getDeletedAt(): ?DateTime;

    public function setDeletedAt(): void;
}
