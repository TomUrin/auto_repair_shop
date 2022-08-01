<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workshop as W;

class Mechanic extends Model
{
    use HasFactory;
    public function workshop()
    {
        return $this->belongsTo(W::class, 'workshop_id', 'id');
    }
}
