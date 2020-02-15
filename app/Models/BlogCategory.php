<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    /**
     * Class BlogCategory
     * @package App\Models
     *
     * @property-read BlogCategory $parentCategory
     * @property-read string  $parentTitle
     */
    use SoftDeletes;
    const ROOT =1;
    protected $fillable= ['title','slug','parent_id','description'];

    /**
     * get parent category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        //this category belongs to
        return $this->belongsTo(BlogCategory::class,'parent_id','id');
    }

    /**
     * @example accessor
     * @url https://laravel.com/docs/5.8/eloquent-mutators
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory->title ?? ($this->isRoot() ? 'Yuxari Kateqoriya yoxdur':'???');
     return $title;
    }

    /**
     * Isset current object inherit
     * @return  bool
     */
    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }

    /**
     * @example accessor (getter)
     * @param string $valueFromObject
     * @return bool|false|mixed|string|string[]|null
     *
     */

//    public  function getTitleAttribute($valueFromObject)
//    {
//        return mb_strtoupper($valueFromObject);
//    }
//
//    /**
//     * @example mutator (setter)
//     * @param $incomingValue
//     */
//    public function setTitleAttribute($incomingValue)
//    {
//        $this->attributes['title'] = mb_strtolower($incomingValue);
//    }
}
