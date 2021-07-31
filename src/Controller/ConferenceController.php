<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceController extends AbstractController
{
	/**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
		return new Response('<html><body>Main Page</body></html>');
    }
	
    /**
     * @Route("/conference", name="conference")
     */
    public function conference(): Response
    {
		return new Response('<html><body>Conference</body></html>');
    }
	
	public function test(): Response
    {
		return new Response('<html><body>Test</body></html>');
    }
}
