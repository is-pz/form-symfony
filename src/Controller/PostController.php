<?php

namespace App\Controller;

use App\Form\PostType;
use Doctrine\ORM\EntityManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/crear', name:'post_create')]
    public function index(Request $request, EntityManager $entityManager): Response
    {
        $form = $this->createForm(PostType::class);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Publicación guardada con éxito');
            return $this->redirectToRoute('post_create');
        }


        return $this->render('post/create.html.twig', [
            'controller_name' => 'PostController',
            'form' => $form->createView(),
        ]);
    }
}
