<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'experience', 'skills', 'approved_by_super_admin'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
