<?php

namespace App\Controller\Admin;

use App\Entity\Pet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pet::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular(
                fn (?Pet $pet, ?string $pageName) => $pet ? $pet->getName() . ' (ID: ' . ($pet->getId()) . ')' : 'Pet'
            )
            ->setEntityLabelInPlural('Pets')
            ->setSearchFields(['name', 'size', 'type'])
            ->renderContentMaximized()
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield ChoiceField::new('size')
            ->setChoices([
                'Toy' => 'toy',
                'Small' => 'small',
                'Medium' => 'medium',
                'Large' => 'large',
                'Giant' => 'giant',
            ])
            ->addCssClass('w-25');
        yield ChoiceField::new('type')
            ->setChoices([
                'Dog' => 'dog',
                'Cat' => 'cat',
                'Bird' => 'bird',
                'Rabbit' => 'rabbit',
                'Reptile' => 'reptile',
                'Tiny mammal' => 'tiny_mammal',
                'Fish' => 'fish',
                'Arachnid' => 'arachnid',
                'Other' => 'other',
            ])
            ->addCssClass('w-25');
        yield TextEditorField::new('description');
        yield DateField::new('dateOfBirth');
        yield AssociationField::new('template')->addCssClass('w-50');
    }
}
