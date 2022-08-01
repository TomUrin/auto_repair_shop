<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mechanic as M;

class Workshop extends Model
{
    use HasFactory;
    public function mechanics()
    {
        return $this->hasMany(M::class, 'workshop_id', 'id');
    }
}
