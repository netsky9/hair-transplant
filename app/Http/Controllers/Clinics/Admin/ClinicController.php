<?php

namespace App\Http\Controllers\Clinics\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clinics\Admin\ClinicUpdateRequest;
use App\Models\Clinic;
use App\Repositories\Clinics\ClinicsPostRepository;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Репозиторий клиник
     * @var
     */
    protected $clinicsPostRepository;

    public function __construct()
    {
        $this->clinicsPostRepository = new ClinicsPostRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = $this->clinicsPostRepository->GetAllWithPagination();

        return view('admin.clinics.index', compact('pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
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
        $item = $this->clinicsPostRepository->GetEdit($id);
        $gallery = $item->getMedia('gallery')->all();
        $miniature = $item->getFirstMedia('miniature');

        return view('admin.clinics.edit', compact('item', 'gallery', 'miniature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicUpdateRequest $request, $id)
    {
        $item = $this->clinicsPostRepository->GetEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"The raw with id={$id} not found!"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item
            ->fill($data)
            ->save();

        if(!empty($data['miniature'])){
            $item->clearMediaCollection('miniature');
            $item->addMedia($data['miniature'])
                ->toMediaCollection('miniature');
        }

        if($result){
            return back()
                ->with(['success'=>"The clinic was changed successful!"]);
        }else{
            return back()
                ->withErrors(['msg'=>"The clinic wasn't changed! Please try again!"]);
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
        dd(__METHOD__);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, $id){
        if(!empty($request->file('file'))){
            $item = Clinic::find($id);
            $item->addMedia($request->file('file'))
                ->toMediaCollection('gallery');

            return response()->json('Success', 200);

        }else{
            return response()->json('File not exist', 404);
        }
    }
}
