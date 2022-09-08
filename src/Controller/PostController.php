<?php

namespace App\Controller;

use App\Form\PostType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/crear', name: 'post_create')]
    public function index(): Response
    {
        $form = $this->createForm(PostType::class);

        return $this->render('post/create.html.twig', [
            'controller_name' => 'PostController',
            'form' => $form->createView(),
        ]);
    }
}
