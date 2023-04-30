<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Verification extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id', 'code', 'attempt', 'status'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

