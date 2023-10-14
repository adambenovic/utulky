<?php

namespace App\Controller\Admin;

use App\Entity\Template;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TemplateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Template::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(
                fn (?Template $template, ?string $pageName) => $template ? $template->getName() . ' (ID: ' . ($template->getId()) . ')' : 'Template'
            )
            ->setEntityLabelInPlural('Templates')
            ->setSearchFields(['name'])
            ->renderContentMaximized()
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->addCssClass('w-50');
        yield AssociationField::new('attributes')->addCssClass('w-50');
        yield AssociationField::new('owner')->addCssClass('w-50');
    }
}
