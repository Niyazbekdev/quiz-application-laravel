<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class   Answer extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
    ];

    protected $casts = [
        'is_correct'=> 'boolean'
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function scopeSearch(Builder $builder, $search)
    {
        $builder->where('answer', 'like', "%{$search}%");
    }
}
