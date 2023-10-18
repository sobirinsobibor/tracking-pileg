<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable =[
        'candidate_name',
        'candidate_artificial_id',
        'candidate_encrypted_id',
        'candidate_gender',
        'candidate_address'
    ];
}
