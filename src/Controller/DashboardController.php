<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller;

use ClownMeister\BohemiaApi\Entity\Post;
use ClownMeister\BohemiaApi\Entity\Role;
use ClownMeister\BohemiaApi\Entity\RoleHierarchy;
use ClownMeister\BohemiaApi\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('pages/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bohemia Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Bohemia Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Posts', 'fas fa-file-lines', Post::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Roles', 'fas fa-list', Role::class);
        yield MenuItem::linkToCrud('Role Hierarchy', 'fas fa-sitemap', RoleHierarchy::class);
        yield MenuItem::linkToUrl('Logout', 'fas fa-arrow-right-from-bracket', '/logout');
    }
}
