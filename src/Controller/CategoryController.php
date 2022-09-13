<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManager;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category_index')]
    public function index(EntityManager $entityManager): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $entityManager->getRepository(Category::class)->findAll()
        ]);
    }

    #[Route('/category/crear', name:'category_create', methods:['GET', 'POST'])]
    public function create(Request $request, EntityManager $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Categoría guardada con éxito');
            return $this->redirectToRoute('category_create');
        }


        return $this->render('category/create.html.twig', [
            'controller_name' => 'CategoryController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id}/editar', name:'category_edit', methods:['GET', 'POST'])]
    public function edit(Category $category,Request $request, EntityManager $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            $this->addFlash('success', 'Categoría editada con éxito');
            return $this->redirectToRoute('category_edit', [
                'id' => $category->getId()
            ]);
        }


        return $this->render('category/edit.html.twig', [
            'controller_name' => 'CategoryController',
            'form' => $form->createView(),
        ]);
    }
}
