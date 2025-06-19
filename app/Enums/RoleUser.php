<?php

namespace App\Enums;

enum RoleUser: string
{
    case Admin   = 'Admin';
    case Seller  = 'Seller';
    case Customer = 'Customer';
}
