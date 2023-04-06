<?php

namespace App\Models;

use App\Models\Categories;
use Jenssegers\Mongodb\Auth\User;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'posts';

    protected $guarded = [];


}
