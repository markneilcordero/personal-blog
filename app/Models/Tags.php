<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'post_tags', 'tag_id', 'post_id');
    }
}
