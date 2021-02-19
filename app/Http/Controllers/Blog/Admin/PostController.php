<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Requests\Blog\Admin\PostUpdateRequest;
use App\Repositories\Blog\BlogCategoryRepository;
use App\Repositories\Blog\BlogPostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * @var BlogPostRepository
     */
    protected $postRepository;

    /**
     * @var BlogCategoryRepository
     */
    protected $categoryRepository;

    public function __construct(){
        $this->postRepository = new BlogPostRepository();
        $this->categoryRepository = new BlogCategoryRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = $this->postRepository->GetAllWithPagination();

        return view('admin.posts.index', compact('pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->postRepository->GetEdit($id);
        $categories = $this->categoryRepository->GetForSelect();

        return view('admin.posts.edit', compact('item', 'categories'));
    }

    /**
     * @param PostUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $data = $request->all();

        /**
         * Switcher
         */
        $data['is_published'] = (empty($data['is_published'])) ? 0 : 1;

        $item = $this->postRepository->GetEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"The post is not found!"]);
        }

        /**
         * если публикуем первый раз, то добавляем дату
         */
        if(empty($item->published_at) && $data['is_published']){
            $item->published_at = Carbon::now();
        }

        $result = $item
            ->fill($data)
            ->save();

        if($result){
            return back()
                ->with(['success'=>"The post was changed successful!"]);
        }else{
            return back()
                ->withErrors(['msg'=>"The post wasn't changed! Please try again!"]);
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
        //
    }
}
