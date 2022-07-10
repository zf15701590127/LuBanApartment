<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserve_status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function lease_type()
    {
        return $this->belongsTo(LeaseType::class);
    }
}
