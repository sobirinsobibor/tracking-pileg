<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectoralDistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'electoral_district_artificial_id',
        'electoral_district_encrypted_id',
        'electoral_district_name',
        'electoral_district_description'
    ];
}
