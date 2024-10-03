<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    public function talkProposal()
    {
        return $this->belongsTo(TalkProposal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
