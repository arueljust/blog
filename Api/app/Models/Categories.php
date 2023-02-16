<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'categories';

    protected $guarded = [];
}
