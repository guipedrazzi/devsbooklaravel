<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{

    public $timestamps = false;
    protected $table = 'postcomments';
    use HasFactory;
}
