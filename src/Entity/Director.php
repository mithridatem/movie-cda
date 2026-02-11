<?php

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Attribute\Groups as AttributeGroups;

#[ORM\Entity(repositoryClass: DirectorRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/director/{id}',
            requirements: ['id' => '\d+'],
            normalizationContext: ['groups' => 'director:item']
        ),
        new GetCollection(
            uriTemplate: '/director',
            normalizationContext: ['groups' => 'director:list']
        ),
    ],
    order: ['id' => 'ASC', 'firstname' => 'ASC', 'lastname' => 'ASC'],
    paginationEnabled: true
)]
class Director
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[AttributeGroups(["director:list", "director:item"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Length(min: 2, max: 50, minMessage: 'Le nom est trop court', maxMessage: 'Le nom est trop long')]
    #[AttributeGroups(["director:list", "director:item"])]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    #[AttributeGroups(["director:list", "director:item"])]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    #[AttributeGroups(["director:list", "director:item"])]
    private ?\DateTimeImmutable $birthDate = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[AttributeGroups(["director:list", "director:item"])]
    private ?string $country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeImmutable $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function __toString(): string
    {
        return $this->firstname . " " . $this->lastname;
    }
}
