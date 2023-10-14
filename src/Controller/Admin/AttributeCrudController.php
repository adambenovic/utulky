<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Attribute;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AttributeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribute::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(
                fn (?Attribute $attribute, ?string $pageName) => $attribute ? $attribute->getName() . ' (ID: ' . ($attribute->getId()) . ')' : 'Question'
            )
            ->setEntityLabelInPlural('Questions')
            ->setSearchFields(['name', 'choices', 'expectedValue'])
            ->renderContentMaximized()
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->addCssClass('w-50');
        yield ChoiceField::new('type')
            ->setChoices([
                'Integer' => 'int',
                'Float' => 'float',
                'String' => 'string',
                'Text' => 'text',
                'Date' => 'date',
                'Image' => 'image',
            ])
            ->addCssClass('w-25');
        yield BooleanField::new('required');
        yield ArrayField::new('choices');
        yield TextField::new('expectedValue')->addCssClass('w-50');
        yield AssociationField::new('templates')->addCssClass('w-50');
    }
}
