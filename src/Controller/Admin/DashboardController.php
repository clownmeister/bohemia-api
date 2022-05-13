<?php

namespace ClownMeister\BohemiaApi\Controller\Admin;

use ClownMeister\BohemiaApi\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('pages/dashboard.html.twig', [
        ]);
    }
}
