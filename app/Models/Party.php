<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_artificial_id',
        'party_encrypted_id',
        'party_name',
        'party_acronym'
    ];
}
