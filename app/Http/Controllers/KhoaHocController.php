<?php

namespace App\Http\Controllers;

use App\KhoaHoc;
use Illuminate\Http\Request;
use App\Http\Resources\KhoaHoc\KhoaHocCollection;
use App\Http\Resources\KhoaHoc\KhoaHocResource;

class KhoaHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KhoaHocCollection::collection(KhoaHoc::all());
        return KhoaHocCollection::collection(KhoaHoc::paginate(5));
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

    public function show(KhoaHoc $khoaHoc,$id)
    {
        $khoaHoc = KhoaHoc::find($id);
        return new KhoaHocResource($khoaHoc);
        // return $khoaHoc;
    }

    
    public function edit(KhoaHoc $khoaHoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KhoaHoc $khoaHoc,$id)
    {
        $khoaHoc = KhoaHoc::find($id);
        // $khoaHoc->update($request->all());
        $khoaHoc->giangvien_id = $request->giangvien_id;
        $khoaHoc->save();
        return response([
            'data' => new KhoaHocResource($khoaHoc),
        ],202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(KhoaHoc $khoaHoc, $id)
    {
        //
    }
}
