<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'biography',
        'date_of_birth',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_revisor' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }

    public function isParent($article_id): bool {
        return $this->articles()->where('id', $article_id)->exists();
    }

    // Funzione di relazione
    public function articles(): HasMany{
        return $this->hasMany(Article::class);
    }

    public function revisorRequest()
    {
        return $this->hasOne(RevisorRequest::class);
    }

    public function adminRequest()
    {
        // dd($this->hasOne(RevisorRequest::class));
        return $this->hasOne(AdminRequest::class);
    }
    
    public function getRoleAttribute()
    {
        if ($this->is_admin) {
            return 'Amministratore';
        } elseif ($this->is_revisor) {
            return 'Revisore';
        } else {
            return 'Writer';
        }
    }
}
