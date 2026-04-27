<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; // <--- Add this line
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model {
    use SoftDeletes;
    
    protected $fillable = ['title', 'description'];
}