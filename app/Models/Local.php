<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'region_id',
    ];

    // Define relationship with the Region model
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
