<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function roomCustomer()
    {
        return $this->belongsTo(RoomCustomer::class);
    }

    public function accountingSubject()
    {
        return $this->belongsTo(accountingSubject::class);
    }
}
