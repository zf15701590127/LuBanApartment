<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractCustomer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'certificate_type_id', 'certificate_no', 'mobile_phone_number',
    ];

    public function certificateType()
    {
        return $this->belongsTo(CertificateType::class);
    }
}
