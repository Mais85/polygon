<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreate;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCategoryUpdate;
use Illuminate\Support\Str;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseController
{

    /**
     *@var BlogCategoryRepository
     */

    private  $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $paginator = BlogCategory::paginate(15);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(25);

        return view('blog.admin.categories.index ',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $item = BlogCategory::make();
        $categoryList = $this->blogCategoryRepository->getForCombobox();
        return view ('blog.admin.categories.edit',compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BlogCategoryCreate  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreate $request)
    {
        //
        $data = $request->input();
       /**
        * moved to observer
        *
        * if(empty($data['slug'])){
         $data['slug'] = Str::slug($data['title']);
        }*/


//        $item = new BlogCategory($data);
//        $item->save();
        $item = BlogCategory::create($data);

        if($item){
            return redirect()->route('blog.admin.categories.edit',[$item->id])->with(['success'=>'Yaradilma emeliyyati muveffeqiyyetle basa catdi!']);
        }else{
            return back()->withErrors(['msg'=>'Sehv, yaradila bilmedi!'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //$item = BlogCategory::findOrFail($id);
        //$categoryList = BlogCategory::all();
        $item = $this->blogCategoryRepository->getEdit($id);
//
//        $v['title_before'] = $item->title;
//        $item->title = 'asdasfdrgDDDDDrebvfdvsdgfr 12121';
//
//        $v['title_after'] = $item->title;
//        $v['getAttribute'] = $item->getAttribute('title');
//        $v['AttributesToArray'] = $item->attributesToArray();
//        $v['attributes'] = $item->attributes['title'];
//        $v['getAttributeValue'] = $item->getAttributeValue('title');
//        $v['getMutatedAttributes'] = $item->getMutatedAttributes();
//        $v['hasGetMutator for title'] = $item->hasGetMutator('title');
//        $v['toArray'] = $item->toArray();
//
//        dd($v,$item);

        if(empty($item)){
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view ('blog.admin.categories.edit',compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request\BlogCategoryUpdate $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(BlogCategoryUpdate $request, $id)
    {
        //
        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            return back()->withErrors(['msg'=>'Qeyd iD =[{$id}] tapilmadi'])->withInput();
        }

         $data = $request->all();
        /**
         *moved to observer
         *
         *if(empty($data['slug'])){
        $data['slug'] = Str::slug($data['title']);
        }
         */
         $result = $item->update($data);
         //->fill($data)->save();

         if($result){
             return redirect()->route('blog.admin.categories.edit',$item->id)->with(['success'=>'Yaradilma emeliyyati muveffeqiyyetle basa catdi!']);
         }else{
             return back()->withErrors(['msg'=>'Sehv, yaradila bilmedi!'])->withInput();
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        //
    }*/
}
