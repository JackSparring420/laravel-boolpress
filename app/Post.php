<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Post extends Model
{
    public function category() {
        return $this -> belongsTo(Category::class);
    }

    public function tags() {
        return $this -> belongsToMany(Tag::class);
    }

    protected $fillable =[

        'title',
        'author',
        'description',
        'release_date',

    ];
}
