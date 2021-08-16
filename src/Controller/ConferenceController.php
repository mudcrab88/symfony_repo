<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Repository\ConferenceRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    private $twig;

    private $commentRepository;

    private $conferenceRepository;

    public function __construct(
        Environment $twig,
        CommentRepository $commentRepository,
        ConferenceRepository $conferenceRepository)
    {
        $this->twig = $twig;
        $this->commentRepository = $commentRepository;
        $this->conferenceRepository = $conferenceRepository;
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
    public function show(Request $request, Conference $conference): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $this->commentRepository->getCommentPaginator($conference, $offset);

        return new Response($this->twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
            ])
        );
    }
}
