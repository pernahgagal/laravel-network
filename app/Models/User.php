<?php

namespace App\Models;

use App\Traits\Following;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Following;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function avatar()
    {
        return 'https://i.pravatar.cc/150?u=' . $this->email;
    }

    public function makeStatus($string)
    {
        return $this->statuses()->create([
            'body' => $string,
            'identifier' => Str::slug(Str::random(31) . $this->id)
        ]);
    }

    public function timeline()
    {
        $follows = $this->follows->pluck('id');
        return Status::whereIn('user_id', $follows)
                            ->orWhere('user_id', $this->id)
                            ->latest()
                            ->get();
    }
}
