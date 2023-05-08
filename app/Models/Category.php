<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
