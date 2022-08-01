<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workshop as W;
use App\Models\Mechanic as M;
use App\Models\Service as S;
use App\Models\User as U;

class Order extends Model
{
    use HasFactory;

    const STATUSES = [
        1 => 'Pending',
        2 => 'Approved',
        3 => 'Cancelled'
    ];

    public function workshop()
    {
        return $this->belongsTo(W::class, 'workshop_id', 'id');
    }
    public function mechanic()
    {
        return $this->belongsTo(M::class, 'mechanic_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(S::class, 'service_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(U::class, 'user_id', 'id');
    }
}
