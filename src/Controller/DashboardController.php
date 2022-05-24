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
    public function __construct(private \ClownMeister\BohemiaApi\Security\RoleHierarchy $hierarchy)
    {
    }

    #[Route('/', name: 'app_dashboard')]
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
        yield MenuItem::linkToCrud('Posts', 'fas fa-file-lines', Post::class)
            ->setPermission('ROLE_POST_VIEW');

        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class)
            ->setPermission('ROLE_USER_VIEW');

        yield MenuItem::linkToCrud('Roles', 'fas fa-list', Role::class)
            ->setPermission('ROLE_ROLE_VIEW');

        yield MenuItem::linkToCrud('Role Hierarchy', 'fas fa-sitemap', RoleHierarchy::class)
            ->setPermission('ROLE_HIERARCHY_VIEW');

        yield MenuItem::linkToRoute('Trash bin', 'fas fa-trash', 'app_trash')
            ->setPermission('ROLE_TRASH_VIEW');

        yield MenuItem::linkToUrl('Logout', 'fas fa-arrow-right-from-bracket', '/logout');
    }
}
