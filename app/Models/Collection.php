<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collections';
    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'description',
        'code',
        'allowed_type',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function allowedUsers()
    {
        $this->belongsToMany(
            related: User::class,
            table: 'allowed_users',
        );
    }
}
