<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Blog\BlogPostRepository;

class PostController extends Controller
{
    /**
     * Blog post repository
     * @var
     */
    protected $blogPostRepository;

    public function __construct(){
        $this->blogPostRepository = new BlogPostRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->blogPostRepository->GetAllWithPagination();

        return view('blog.blog', compact('items'));
    }

    public function show($slug){
        $item = $this->blogPostRepository->GetShow($slug);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "This post not found!"]);
        }

        $nextItem = $this->blogPostRepository->GetNextPost($item);

        return view('blog.show', compact('item', 'nextItem'));
    }
}
