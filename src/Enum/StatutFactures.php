<?php

namespace App\Enum;

enum StatutFactures: string
{
    case En_attente = 'en_attente';
    case Payee = 'payée';
    case Annulee = 'annulée';
}
