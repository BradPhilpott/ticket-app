<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapFeature extends Model
{
    use HasFactory;

    protected $fillable = ['property', 'type', 'placement'];
}
