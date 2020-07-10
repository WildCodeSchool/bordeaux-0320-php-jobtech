<?php

namespace App\Controller\Admin;

use App\Entity\JobCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JobCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobCategory::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
