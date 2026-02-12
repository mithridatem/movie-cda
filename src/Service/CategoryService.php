<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{
    public function __construct(
        private EntityManagerInterface $em,
        private CategoryRepository $categoryRepository
    ) {}

    public function saveCategory(Category $category): array
    {
        //Test si l'objet category existe
        if (!$category) {
            return ["type"=>"warning", "message"=> "la category n'existe pas"];
        }

        //test si la category existe déja
        if ($this->categoryRepository->findOneBy(["name" => $category->getName()])) {
            return ["type"=>"danger", "message"=> "la category existe déjà"];
        }
        
        //Ajout en BDD
        $this->em->persist($category);
        $this->em->flush();

        return ["type"=>"success", "message"=> "la category a été ajouté"];
    }
}
