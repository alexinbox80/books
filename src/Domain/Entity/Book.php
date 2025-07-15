<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Interface\EntityInterface;
use App\Domain\Entity\Interface\HasMetaTimestampsInterface;
use App\Domain\Entity\Traits\CreatedAtTrait;
use App\Domain\Entity\Traits\DeletedAtTrait;
use App\Domain\Entity\Traits\UpdatedAtTrait;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert as WebmozartAssert;

#[ORM\Table(name: 'book')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Index(name: 'book__title__ind', columns: ['title'])]
class Book implements EntityInterface, HasMetaTimestampsInterface
{
    use CreatedAtTrait, UpdatedAtTrait, DeletedAtTrait;

    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'books')]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    private Author $author;

    #[ORM\Column(name: 'title', type: 'string', length: 128, nullable: false)]
    private string $title;

    #[ORM\Column(name: 'description', type: 'string', length: 1024, nullable: true)]
    private ?string $description = null;

    public function __construct(string $title, ?string $description = null)
    {
        self::titleValidate($title);

        $this->title = $title;
        $this->description = $description;
    }

    public function getId(): int
    {
        WebmozartAssert::notNull($this->id, sprintf('Id of Entity %s is null.', get_class($this)));

        return $this->id;
    }

    private function titleValidate(string $title): void
    {
        WebmozartAssert::stringNotEmpty($title, 'Title should not be empty. Got: %s');
        //Assert::regexp()
        WebmozartAssert::alpha($title, 'Title should be in alphabet. Got: %s');
        WebmozartAssert::lengthBetween($title, 2, 64, 'Title must be a string valid length of 2-64 letters. Got: %s');
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }
}
