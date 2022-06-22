<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    public function contractType()
    {
        return $this->belongsTo(contractType::class);
    }

    public function leaseType()
    {
        return $this->belongsTo(leaseType::class);
    }

    public function signContractType()
    {
        return $this->belongsTo(signContractType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function marketingChannel()
    {
        return $this->belongsTo(marketingChannel::class);
    }

    public function depositMonth()
    {
        return $this->belongTo(depositMonth::class);
    }

    public function contractCustomer()
    {
        return $this->belongsTo(contractCustomer::class);
    }

    public function room()
    {
        return $this->belongsTo(room::class);
    }
}
