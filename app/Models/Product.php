<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'slug',
        'title',
        'barista_id',
        'description',
        'photo'
    ];

    public function barista(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
