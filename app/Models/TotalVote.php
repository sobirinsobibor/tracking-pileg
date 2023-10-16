<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_vote_vote_count',
        'id_party',
        'id_voting_place',
    ];
}
