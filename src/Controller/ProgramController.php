<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Entity\Program;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [
           'programs' => $programs,
           'website' => 'Wild Series'
        ]);
    }
    #[Route('/{id}', name: 'show')]
    public function show(int $id, Program $program): Response
    {
        if (!$program) {
        throw $this->createNotFoundException(
            'No program with id : '.$id.' found in program\'s table.'
        );
    }
    return $this->render('program/show.html.twig', [
        'program' => $program,
    ]);
}

  
#[Route('/{program}/seasons/{season}',methods: ['GET'], name: 'season')]
public function showSeason(Program $program, Season $season): Response
{
    return $this->render('program/season.html.twig', [
        'season' => $season,
        'program' => $program,
    ]);
} 

#[Route('/{program}/season/{season}/episode/{episode}',methods: ['GET'], name: 'episode')]
public function showEpisode(Program $program, Season $season, Episode $episode): Response
{
    return $this->render('program/season/episode.html.twig', [
    'program' => $program,
    'season' => $season,
    'episode' => $episode
]);
}
    
}