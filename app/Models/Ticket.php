<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'priority', 'details', 'price', 'start_date', 'end_date'];
    
    public function priority(): belongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function suppliers(): belongsToMany
    {
        return $this->belongsToMany(Supplier::class);
    }
}
