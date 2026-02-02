<?php

namespace App\Controller\Admin;

use App\Entity\Factures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use App\Enum\StatutFactures;

class FacturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Factures::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('Reservations'),
            MoneyField::new('montantTotal')->setCurrency('EUR'),
            ChoiceField::new('statut')
                ->setChoices([
                    'En attente' => StatutFactures::En_attente,
                    'Payée' => StatutFactures::Payee,
                    'Annulée' => StatutFactures::Annulee,
                ]),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
        ];
    }
}