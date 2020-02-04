<?php

namespace App\Repositories;

class Validation
{
    public function validateQuantity($quantity)
    {
        return $quantity >=0 && $quantity < 999999;

    }

  
}
