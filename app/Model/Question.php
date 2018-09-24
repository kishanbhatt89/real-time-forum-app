<?php

namespace App\Model;

use App\User;
use App\Model\Reply;
use App\Model\Category;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{


    protected static function boot()
    {

        parent::boot();

        static::creating(function ($question) {
            $question->slug = str_slug($question->title);
        });
        
    }



    protected $fillable = ['title','slug','body','category_id','user_id'];
    
    //protected $guarded = [];

    /*
        Tells laravel to search for given field i.e. "slug" instead of "id" in Route Model Binding
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    /*
        By adding this we can access 'path' like $this->path which return path of this 'slug' from the root[Base URL.]
    */
    public function getPathAttribute()
    {
        return "question/$this->slug";
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
