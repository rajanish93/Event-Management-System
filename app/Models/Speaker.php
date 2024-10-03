<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = ['name', 'email'];
    public function talkProposals()
    {
        return $this->hasMany(TalkProposal::class);
    }
}
