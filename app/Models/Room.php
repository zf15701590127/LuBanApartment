<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'building_id',
        'name',
        'floor',
        'purpose_id',
        'status_mark',
        'reservation_id',
        'contract_id',
        'benchmark_price',
        'store_price',
        'order',
        'project_id',
        'area',
        'move_out_date'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function reserve()
    {
        return $this->hasOne(Reserve::class);
    }
}
