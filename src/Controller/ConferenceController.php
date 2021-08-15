<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Repository\ConferenceRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    /**
     * @Route("/", name="homepage")
     * @param Environment          $twig
     * @param ConferenceRepository $conferenceRepository
     *
     * @return Response
     */
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return new Response($this->twig->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]));
    }

    public function test(): Response
    {
        return new Response('<html><body>Test</body></html>');
    }

    #[Route('/conference/{id}', name: 'conference')]
    public function show(Conference $conference, CommentRepository $commentRepository): Response
    {
        return new Response($this->twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $commentRepository->findBy(['conference' => $conference], ['createdAt' => 'DESC']),
        ]));
    }
}
