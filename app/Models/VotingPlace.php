<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingPlace extends Model
{
    use HasFactory;
    protected $fillable = [
        'voting_place_artificial_id',
        'voting_place_encrypted_id',
        'voting_place_name',
        'voting_place_address',
        'voting_place_sub_district',
        'voting_place_district',
        'voting_place_city',
        'voting_place_province',
        'id_electoral_district'
    ];
}
