<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    public function talkProposals()
    {
        return $this->hasMany(TalkProposal::class);
    }
}
