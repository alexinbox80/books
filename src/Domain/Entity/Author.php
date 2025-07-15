<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Interface\EntityInterface;
use App\Domain\Entity\Interface\HasMetaTimestampsInterface;
use App\Domain\Entity\Traits\CreatedAtTrait;
use App\Domain\Entity\Traits\DeletedAtTrait;
use App\Domain\Entity\Traits\UpdatedAtTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert as WebmozartAssert;

#[ORM\Table(name: 'author')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Index(name: 'author__last_name__first_name__ind', columns: ['last_name', 'first_name'])]
#[ORM\Index(name: 'author__first_name__last_name__ind', columns: ['first_name', 'last_name'])]
class Author implements EntityInterface, HasMetaTimestampsInterface
{
    use CreatedAtTrait, UpdatedAtTrait, DeletedAtTrait;

    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\Column(name: 'last_name', type: 'string', length: 64, nullable: false)]
    private string $lastName;

    #[ORM\Column(name: 'first_name', type: 'string', length: 64, nullable: false)]
    private string $firstName;

    #[ORM\Column(name: 'description', type: 'string', length: 1024, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'author')]
    private Collection $books;

    public function __construct(string $lastName, string $firstName, ?string $description = null)
    {
        self::lastNameValidate($lastName);
        self::firstNameValidate($firstName);

        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->description = $description;

        $this->books = new ArrayCollection();
    }

    public function getId(): int
    {
        WebmozartAssert::notNull($this->id, sprintf('Id of Entity %s is null.', get_class($this)));

        return $this->id;
    }

    private function lastNameValidate(string $lastName): void
    {
        WebmozartAssert::stringNotEmpty($lastName, 'Last name should not be empty. Got: %s');
        //Assert::regexp()
        WebmozartAssert::alpha($lastName, 'Last name should be in alphabet. Got: %s');
        WebmozartAssert::lengthBetween($lastName, 2, 64, 'The last name must be a string valid length of 2-64 letters. Got: %s');
    }

    private function firstNameValidate(string $firstName): void
    {
        WebmozartAssert::stringNotEmpty($firstName, 'First name should not be empty. Got: %s');
        //Assert::regexp()
        WebmozartAssert::alpha($firstName, 'First name should be in alphabet. Got: %s');
        WebmozartAssert::lengthBetween($firstName, 2, 64, 'The first name must be a string valid length of 2-64 letters. Got: %s');
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function changeFields(
        string $lastName,
        string $firstName,
        ?string $description = null
    ): void
    {
        self::lastNameValidate($lastName);
        self::firstNameValidate($firstName);

        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->description = $description;
    }
}
