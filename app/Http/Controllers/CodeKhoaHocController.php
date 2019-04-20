<?php

namespace App\Http\Controllers;

use App\CodeKhoaHoc;
use Illuminate\Http\Request;
use App\Http\Resources\CodeKhoaHoc\CodeKHResource;
use App\Http\Requests\CodeKHRequest;
use Excel;
use App\Imports\CodeKHImport;
use App\KhoaHoc;

class CodeKhoaHocController extends Controller
{
    //Chỉ admin mới có quyền trong trang này
    public function __construct()
    {
        $this->middleware('auth:api')->except('testReport');
        $this->middleware('isAdmin')->except('testReport');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CodeKHResource::collection(CodeKhoaHoc::all()->sortBy('KhoaHoc_id'));
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
    public function store(CodeKHRequest $request)
    {
        $code = new CodeKhoaHoc;
        $code->code = $request->code;
        $code->KhoaHoc_id = $request->KhoaHoc_id;
        $code->TrangThai = 1;
        $code->save();

        return response([
            'data' => new CodeKHResource($code),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CodeKhoaHoc  $codeKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function show(CodeKhoaHoc $CodeKhoaHoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CodeKhoaHoc  $codeKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function edit(CodeKhoaHoc $CodeKhoaHoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CodeKhoaHoc  $codeKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodeKhoaHoc $CodeKhoaHoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CodeKhoaHoc  $codeKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(CodeKhoaHoc $CodeKhoaHoc)
    {
        $CodeKhoaHoc->delete();

        $tenKh = $CodeKhoaHoc->khoa_hoc->TenKH;
        return response([
            'data' => "Xóa thành công $CodeKhoaHoc->code của khóa học $tenKh ",
        ]);
    }

    public function import(Request $request)
    {
        request()->validate(
            [
                'file' => 'required|mimes:xlsx',
            ],
            [
                'file.required' => 'Bạn chưa chọn file',
                'file.mimes' => 'File bạn chọn không đúng định dạng. Chỉ được chọn file .xlsx (excel)'
            ]
        );
        if(!request()->file('file'))
        {    
            return response()->json("Bạn chưa chọn file"); 
        }
        Excel::import(new CodeKHImport, request()->file('file'));
        return response()->json([
            'data' => "Import code khóa học thành công"
        ],200);
    }

    public function testReport()
    {
        $khoahoc = KhoaHoc::all();
        $dem = count($khoahoc);
        $collection = collect();
        $i = 1;
        foreach($khoahoc as $kh)
        {
            $soCode = $kh->code_KH->count();
            $soCodeConLai = $kh->code_KH->where('TrangThai',1)->count();
            $arr = [
                'STT' => $i++,
                'KhoaHoc' => $kh->id,
                'SoCode' => $soCode,
                'SoCodeConLai' => $soCodeConLai,
            ];
            $collection->add($arr);
        }
        return $collection;

        // return $dem;
    }
}
