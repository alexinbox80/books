<?php

namespace App\Domain\Entity\Interface;

interface HasMetaTimestampsInterface
{
    public function setCreatedAt(): void;

    public function setUpdatedAt(): void;
}
