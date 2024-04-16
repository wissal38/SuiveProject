<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compteur extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'numero',
        'type_compteur',
        'local_id',
        
    ];

    // Define relationship with the Local model
    public function local()
    {
        return $this->belongsTo(Local::class);
    }
}
