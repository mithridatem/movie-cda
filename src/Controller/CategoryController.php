<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;

final class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    #[Route('/category/add', name: 'app_category_add', methods: ["GET", "POST"])]
    public function addCategory(Request $request): Response
    {
        //Créer un objet Category
        $category = new Category();
        //Créer un formulaire
        $form = $this->createForm(CategoryType::class, $category);
        //Associer la request
        $form->handleRequest($request);

        //test si le formulaire est submit
        if ($form->isSubmitted() && $form->isValid()) {
            //gestion de l'ajout en BDD
            $flash = $this->categoryService->saveCategory($category);
            //envoi du message
            $this->addFlash($flash["type"], $flash["message"]);
            //redirection
            return $this->redirectToRoute('app_category_add');
        }

        return $this->render('category/add_category.html.twig', [
            'form' => $form
        ]);
    }
}
