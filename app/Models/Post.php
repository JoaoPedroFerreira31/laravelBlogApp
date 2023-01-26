<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, UuidTrait, SoftDeletes;

    protected $appends = ['authorName'];

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title',
        'content',
        'author',
        'updated_at',
        'created_at',
    ];

    public function getAuthorNameAttribute()
    {

        $user = User::find($this->author);

        return $user->name;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
