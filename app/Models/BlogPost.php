<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
     use SoftDeletes;
    const UNKNOWN_USER = 1;
    protected $fillable = ['title','slug','category_id','excerpt','content_raw','is_published','published_at'];

     //protected $dates = ['published_at'];
    /**
     * Category posts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public  function category()
    {
        // Post belongs to Category
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Author post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        // Post belongs to user
        return $this->belongsTo(User::class);
    }

}
