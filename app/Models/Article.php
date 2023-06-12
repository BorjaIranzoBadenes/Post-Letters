<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory,Searchable;

    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'category' => $this->category,
            'created_at' => $this->created_at,
        ];
        
    }

    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'image',
        'user_id',
        'category_id',
        'is_accepted',
        'slug',
    ];

    public function user() {
        return $this -> belongsTo(User::class);
    }

    public function category() {
        return $this -> belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function readDuration() {
        $totalWords = str_word_count($this->body);
        $minutesToRead = round($totalWords / 200);

        return intval ($minutesToRead);
    }
}
