<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'page_name',
    ];

    /**
     * Belongs to a person.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the posts.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
