<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFollow\Followable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use UuidTrait;
    use HasRoles;
    use SoftDeletes;
    use Followable;
    use UploadImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob',
        'country',
        'company',
        'description',
        'website',
        'first_name',
        'last_name',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *  Attributes
     */
    public function getFollowersCountAttribute() {
        return $this->followers()->count();
    }

    public function getFollowingsCountAttribute() {
        return $this->followings()->count();
    }

    public function getPendingRequestsCountAttribute() {
        return $this->pendingRequests()->count();
    }


    /**
     * Relationships.
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
