<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Blog\BlogPostRepository;

class HomeController extends Controller
{
    /**
     * Blog post repository
     * @var
     */
    protected $blogPostRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->blogPostRepository = new BlogPostRepository();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogPosts = $this->blogPostRepository->GetAllWithPagination();
        return view('home', compact('blogPosts'));
    }
}
