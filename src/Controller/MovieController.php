<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Form\MovieType;
use App\Entity\Movie;

final class MovieController extends AbstractController
{

    public function __construct(
        private Security $security,
        private EntityManagerInterface $em,
        private string $directory
    ) {}

    #[Route('/movie/add', name: 'app_add_movie')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request): Response
    {
        //récupération de l'utilisateur connecté
        $user = $this->security->getUser();
        //Création du formulaire
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        //test si le fomulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            //récupération du ficher
            $file = $form['cover']->getData();

            //test si le fichier existe
            if($file) {
                //déplace dans public/img
                $file->move($this->directory, $file->getClientOriginalName());
                $movie->setCover($file->getClientOriginalName());
            }
            
            //setter les attributs
            $movie->setProprietary($user);
            //Ajout en BDD
            $this->em->persist($movie);
            $this->em->flush();
            //Message
            $this->addFlash('success', 'Le film à été ajouté');
            //redirection
            $this->redirectToRoute('app_add_movie');
        }

        return $this->render('movie/add_movie.html.twig', [
            'form' => $form
        ]);
    }
}
