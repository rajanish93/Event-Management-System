<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Many-to-Many Relationship: A tag can belong to many talk proposals.
     */
    public function talkProposals()
    {
        return $this->belongsToMany(TalkProposal::class, 'talk_proposal_tag');
    }
}
