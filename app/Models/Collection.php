<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperCollection
 */
class Collection extends Model
{
    use HasFactory;
    use SoftDeletes;
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
        return $this->hasMany(Question::class)->with('answers');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch(Builder $builder, $search)
    {
        $builder->where('name', 'like', "%{$search}%")
            ->OrWhere('description', 'like', "%{$search}%");
    }

    public function allowedUsers(): BelongsToMany
    {
       return $this->belongsToMany(
            related: User::class,
            table: 'allowed_users',
        );
    }
}
