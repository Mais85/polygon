<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    /**
     *@var BlogPostRepository
     */

    private  $blogPostRepository;

    /**
     *@var BlogCategoryRepository
     */
    private  $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
        $this->blogPostRepository = app(BlogPostRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paginator = $this->blogPostRepository->getAllWithPaginate();
        return view('blog.admin.posts.index ',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view ('blog.admin.posts.edit',compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        //
        $data = $request->input();
        $item = (new BlogPost())->create($data);

        if($item){
            $job = new BlogPostAfterCreateJob($item);
            $this->dispatch($job);
            return redirect()->route('blog.admin.posts.edit',[$item->id])->with(['success'=>'Yaradildi!']);
        }else{
            return back()->withErrors(['msg'=>'Yaradilmada sehv'])->withInput();
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
        $item = $this->blogPostRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForCombobox();

        return view ('blog.admin.posts.edit',compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
       $item = $this->blogPostRepository->getEdit($id);

       if(empty($item)){
           return  back()->withErrors(['msg' => 'Yazi id=[{$id}] tapilmadi !'])->withInput();
       }

        $data = $request->all();
        /**
         * moved to observer
       if(empty($data['slug'])){
           $data['slug'] = Str::slug($data['title']);
       }
       if(empty($item->published_at) && $data['is_published']){
           $data['published_at'] = Carbon::now();
       }
         */

       $result = $item->update($data);

       if($result){
           return redirect()->route('blog.admin.posts.edit',$item->id)->with(['success'=>'Yenilendi !']);
       }else{
           return  back()->withErrors(['msg' => 'Yenilenmede sehv !'])->withInput();
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft-delete
       $result = BlogPost::destroy($id);

       //force delete from DB
//        $result = BlogPost::find($id)->forceDelete();

        if($result){

            BlogPostAfterDeleteJob::dispatch($id)->delay(20);
            //varianti zapuska

//            BlogPostAfterDeleteJob::dispatchNow($id);

//            dispatch(new BlogPostAfterDeleteJob($id));
//            dispatch_now(new BlogPostAfterDeleteJob($id));
//
//            $this->dispatchNow(new BlogPostAfterDeleteJob($id));
//            $this->dispatch(new BlogPostAfterDeleteJob($id));



            return redirect()->route('blog.admin.posts.index')->with(["success" => "Meqale id = $id silindi "]);
        }else{
            return back()->withErrors(['msg' => 'Silinmede sehv!']);
        }
    }
}
