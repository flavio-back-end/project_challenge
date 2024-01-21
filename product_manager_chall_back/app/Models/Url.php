<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['original_url', 'short_url', 'clicks'];
    protected $dates = ['deleted_at']; 
    use HasFactory;
}
