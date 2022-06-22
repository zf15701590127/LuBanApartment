<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomCustomer extends Model
{
    use HasFactory, SoftDeletes;

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
