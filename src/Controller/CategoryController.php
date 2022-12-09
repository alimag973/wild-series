<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): response
    {
       $category = $categoryRepository->findOneBy(['name' => $categoryName]);

       if(!$category) {
        throw $this->createNotFoundException('No categorie named : ' . $categoryName);
       }

       $programs = $programRepository->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3);

       return $this->render('category/show.html.twig', 
       ['programs' => $programs,
       'category' => $category
    ]);

    }

}
