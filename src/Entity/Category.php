<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Attribute\Groups as AttributeGroups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/category/{id}',
            requirements: ['id' => '\d+'],
            normalizationContext: ['groups' => 'category:item']
        ),
        new GetCollection(
            uriTemplate: '/category',
            normalizationContext: ['groups' => 'category:list']
        ),
        new Post(
            uriTemplate: '/category',
            status: 301
        ),
        new Delete(
            uriTemplate: '/category/{id}',
            requirements: ['id' => '\d+'],
        )
    ],
    order: ['id' => 'ASC', 'name' => 'ASC'],
    paginationEnabled: true
)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[AttributeGroups(["category:list", "category:item"])]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique:true)]
    #[AttributeGroups(["category:list", "category:item"])]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
