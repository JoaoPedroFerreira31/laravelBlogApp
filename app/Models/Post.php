<?php

namespace App\Models;

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
    ];

    public function getAuthorNameAttribute() {

        $user = User::findOrFail($this->author);

        return $user->name;
    }

    public function author() {
        $this->belongsTo(User::class);
    }
}
