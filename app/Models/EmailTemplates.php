<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles as HasRolesTrait;

class EmailTemplates extends Model
{
    use HasRolesTrait;
    use HasFactory;

    protected $table = "email_templates"; // Use the correct property name for table declaration

    protected $fillable = [
        'title',
        'tags',
        'template',
        'slug',
        'description',
        'status'
    ];
}
