<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BlogCategoryRepository extends CoreRepository
{
    /**
    * @return string
    */
    protected function getModelClass(){
        return Model::class;
    }

    /**
     *  get model for update admin
     * @param int $id
     * @return Model
     */

    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    /**
     * get list of cateogries for show combobox list
     * @return Collection
     */
    public function getForCombobox(){
        //return $this->startConditions()->all();

        $columns = implode(',',[
           'id','CONCAT (id,". ",title) AS id_title',
        ]);

       /* $result[] = $this->startConditions()->all();
        $result[] = $this->startConditions()->select('blog_categories.*',DB::raw('CONCAT (id,". ",title) AS id_title '))
           // ->toBase()
            ->get();*/

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * get category with paginate
     * @param int\null $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function getAllWithPaginate($perPage=null){

        $columns= ['id','title','parent_id'];
        $result = $this->startConditions()
            ->select($columns)
            ->with(['parentCategory:id,title'])
            ->paginate($perPage);
        return $result;
    }

}

