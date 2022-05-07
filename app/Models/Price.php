<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'deposit',
        'cold_water_fee',
        'electricity_fee',
        'change_room_fee',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
