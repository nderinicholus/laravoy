<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'category_id', 'title', 'seo_title', 'excerpt', 'body', 'image', 'slug', 'meta_description', 'meta_keywords', 'status', 'featured', 'user_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
 
    public function user() {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        if(auth()->check()) {
            static::addGlobalScope('by_user', function (Builder $builder) {
                $builder->where('user_id', '=', auth()->id());
            });
        }
    }
}
