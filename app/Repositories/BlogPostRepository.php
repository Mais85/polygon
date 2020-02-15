<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;


class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass(){
        return Model::class;
    }

    /**
     * get list posts for input
     * (admin panel)
     * @return LengthAwarePaginator
     */

    public function getAllWithPaginate(){
        $columns = [
           'id','title','slug','is_published','published_at','user_id','category_id'
        ];

        $result = $this->startConditions()
              ->select($columns)
              ->orderBy('id','desc')
              //->with(['category','user'])
              ->with([
                  // 1ci variant
                  'category' => function($query){
                  $query->select(['id','title']);
                  },
                  //2ci var``
                  'user:id,name',
              ])
              ->paginate(25);
        return $result;
    }

    /**
     * Get model for editing from admin panel
     * @param int $id
     * @return Model
     */

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}

