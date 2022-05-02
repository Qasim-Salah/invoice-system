<?php

namespace App\Enums;


enum InvoiceType: string
{
    case Driven = '1';
    case Unpaid = '2';
    case Partially = '3';

}
