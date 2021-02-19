<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\Blog\Admin\CategoryCreateRequest;
use App\Http\Requests\Blog\Admin\CategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Http\Controllers\Blog\BaseController;
use App\Repositories\Blog\BlogCategoryRepository;


class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $categoryRepository;

    public function __construct(){
        $this->categoryRepository = new BlogCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = $this->categoryRepository->GetAllWithPagination();

        return view('admin.categories.index', compact('pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = $this->categoryRepository->GetForSelect();

        return view('admin.categories.create', compact('categoryList'));
    }

    /**
     * @param CategoryCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryCreateRequest $request)
    {
        $category = $request->input();

//        if(empty($category['slug'])){
//            $category['slug'] = str_slug($category['title']);
//        }

        $result = (new BlogCategory)->create($category);

        if($result){
            return redirect()
                    ->route('blog.admin.categories.edit', [$result->id])
                    ->with(['success'=>'The category was added!']);
        }else{
            return back()
                    ->withErrors(['msg'=>'The category was not added! Please try again!'])
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->GetEdit($id);
        $categoryList = $this->categoryRepository->GetForSelect();

        return view('admin.categories.edit', compact('category', 'categoryList'));
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $item = $this->categoryRepository->GetEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"The raw with id={$id} not found!"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();

        if($result){
            return back()
                ->with(['success'=>"The category was changed successful!"]);
        }else{
            return back()
                ->withErrors(['msg'=>"The category wasn't changed! Please try again!"]);
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
