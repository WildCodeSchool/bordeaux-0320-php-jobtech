<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

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

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        // FIELDS
        $description = TextareaField::new('description');
        $id = IntegerField::new('id', 'ID');
        $title = TextField::new('title', 'Titre');
        $isExternal = Field::new('isExternal', 'Lien Externe?');
        $url = UrlField::new('url', 'Lien vers l\'article');
        $article = TextEditorField::new('article', 'Contenu de l\'article');
        $image = UrlField::new('image', 'Lien de l\'image');
        $postedAt = DateTimeField::new('postedAt', 'Poster Le');

        // PANELS
        $internal = FormField::addPanel('Actualité interne');
        $external = FormField::addPanel('Actualité externe');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $title, $description, $postedAt];
        }

        if (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $title, $description, $image, $postedAt, $isExternal, $internal, $article, $external, $url];
        }

        if (Crud::PAGE_NEW === $pageName) {
            return [$title, $description, $image, $isExternal, $internal, $article, $external, $url];
        }

        if (Crud::PAGE_EDIT === $pageName) {
            return [$title, $description, $image, $isExternal, $internal, $article, $external, $url];
        }
    }
}
