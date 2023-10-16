<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_vote_vote_count',
        'id_voting_place',
        'id_candidate',
    ];
}
