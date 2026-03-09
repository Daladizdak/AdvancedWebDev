<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopHero extends Model
{
    protected $fillable = [
        'hero_name',
        'role',
        'description',
        'image'
    ];
}