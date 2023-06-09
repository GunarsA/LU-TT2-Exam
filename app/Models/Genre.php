<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre',
    ];

    /**
     * Get the content for the genre.
     */
    public function content()
    {
        return $this->belongsToMany(Content::class, 'content_genres');
    }
}
