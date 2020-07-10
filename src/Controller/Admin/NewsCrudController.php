<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Actualité')
            ->setEntityLabelInPlural('Actualités')
            ->setPageTitle('index', 'Liste des %entity_label_plural%')
            ->setPaginatorPageSize(20)
            ->setDefaultSort(['postedAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        $description = TextareaField::new('description');
        $id = IntegerField::new('id', 'ID');
        $title = TextField::new('title', 'Titre');
        $isExternal = Field::new('isExternal', 'Lien Externe?');
        $url = TextareaField::new('url', 'Lien vers l\'article');
        $article = TextEditorField::new('article', 'Contenu de l\'article');
        $image = TextField::new('image', 'Lien de l\'image');
        $postedAt = DateTimeField::new('postedAt', 'Poster Le');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$title, $description, $postedAt];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $title, $description, $isExternal, $url, $article, $image, $postedAt];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$title, $description, $article];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$title, $description, $article];
        }
    }
}
