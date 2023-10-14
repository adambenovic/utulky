<?php

namespace App\Controller\Admin;

use App\Entity\Attribute;
use App\Entity\Application;
use App\Entity\Template;
use App\Entity\Pet;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
//    #[IsGranted('ROLE_ADMIN', 'ROLE_SUPER_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PawHub Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Templates', 'fas fa-table-list', Template::class);
        yield MenuItem::linkToCrud('Questions', 'fas fa-question', Attribute::class);
        yield MenuItem::linkToCrud('Pets', 'fas fa-dog', Pet::class);
        yield MenuItem::linkToCrud('Applications', 'fas fa-table-list', Application::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateFormat('dd.MM.Y')
            ->setTimeFormat('H:i:s')
            ->showEntityActionsInlined()
            ->setPaginatorPageSize(30)
            ->hideNullValues();
    }
}
