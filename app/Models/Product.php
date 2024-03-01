<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles as HasRolesTrait;

class Product extends Model
{
    use HasRolesTrait;
    use HasFactory;

    protected $table = "products"; // Use the correct property name for table declaration

    protected $fillable = [
        'name',
        'price',
        'product_image',
        'user_id'
    ];

    public function hasAnyRole($roles)
    {
        return $this->hasRole($roles);
    }
}
