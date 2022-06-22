<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\eloquent\SoftDeletes;

class SignContractType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];
}
