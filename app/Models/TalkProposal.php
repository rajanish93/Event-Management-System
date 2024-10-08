<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalkProposal extends Model
{

    protected $fillable = ['speaker_id', 'title', 'description', 'file_path', 'status'];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function revisions()
    {
        return $this->hasMany(Revision::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
