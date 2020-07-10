<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use App\Entity\JobCategory;
use App\Entity\News;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/build/images/logo.png" style="height: 75px; width: auto;"/>')
            ->setFaviconPath('/build/images/favicon.png');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateTimeFormat('dd/MM/yyyy HH:mm:ss');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Site');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Actualité', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Nouvelle actualité', 'fa fa-plus', News::class)
                ->setAction('new'),
            MenuItem::linkToCrud('Liste des actualités', 'fa fa-list', News::class)
        ]);

        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('Candidats', 'fa fa-user-secret', User::class)
            ->setController(CandidatCrudController::class);
        yield MenuItem::linkToCrud('Entreprises', 'fa fa-user-tie', User::class)
            ->setController(CompanyCrudController::class)
            ->setDefaultSort(['createdAt' => 'DESC']);

        yield MenuItem::section('Métiers');
        yield MenuItem::linkToCrud('Secteurs d\'activités', 'fa fa-th-large', JobCategory::class);
        yield MenuItem::linkToCrud('Métiers', 'fa fa-stream', Job::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getCandidate()->getFullname())
            ->displayUserName(true)
            ->displayUserAvatar(true)
            ->addMenuItems([
                MenuItem::linkToRoute('Index', 'fa fa-id-card', 'index'),
            ]);
    }
}
