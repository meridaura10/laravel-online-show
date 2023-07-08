<?php

namespace App\Enums;

enum OrderPaySystemEnum:string {
    case Card = 'card';
    case Cash = 'cash';
}
