<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Requests\Blog\Admin\PostCreateRequest;
use App\Http\Requests\Blog\Admin\PostUpdateRequest;
use App\Models\BlogPost;
use App\Repositories\Blog\BlogCategoryRepository;
use App\Repositories\Blog\BlogPostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
        $categories = $this->categoryRepository->GetForSelect();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * @param PostCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->input();

        $result = (new BlogPost())->create($data);

        if($result){
            return redirect()
                ->route('blog.admin.posts.edit', [$result->id])
                ->with(['success'=>'The post was added!']);
        }else{
            return back()
                ->withErrors(['msg'=>'The post was not added! Please try again!'])
                ->withInput();
        }
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

        $item = $this->postRepository->GetEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"The post is not found!"]);
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
        $item = $this->postRepository->GetEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"The post is not found!"]);
        }

        $result = BlogPost::destroy($id);

        if($result){
            return redirect()
                ->route('blog.admin.posts.index')
                ->with([
                    'success'=>"The post was deleted successful!",
                    'restore'=>$id
                ]);
        }else{
            return back()
                ->withErrors(['msg'=>"The post was not deleted!"]);
        }
    }

    /**
     * @param $id
     */
    public function restore($id){
        $result = BlogPost::withTrashed()->find($id)->restore();

        if($result){
            return redirect()
                ->back()
                ->with(['success'=>"The post was recovered successful!"]);
        }else{
            return back()
                ->withErrors(['msg'=>"The post was not recovered!"]);
        }
    }
}
