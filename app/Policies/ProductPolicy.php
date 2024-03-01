<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
   
    public function view(User $user, Product $product)
    {
        if ($user->hasRole('administrator')) {
            return true; // Administrator can view all products
        }
        // dd($product->user_id);
        return $user->id === $product->user_id;
        
    }

   
}
