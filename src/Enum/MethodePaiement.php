<?php

namespace App\Enum;

enum MethodePaiement: string
{
    case Carte = 'carte';
    case Especes = 'especes';
    case Virement = 'virement';
}
