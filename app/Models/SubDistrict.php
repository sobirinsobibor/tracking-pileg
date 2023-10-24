<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_district_name',
        'sub_district_artificial_id',
        'sub_district_encrypted_id',
        'id_district'
    ];
}
