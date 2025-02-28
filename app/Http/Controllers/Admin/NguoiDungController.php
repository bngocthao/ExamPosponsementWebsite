<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use app\Service\AdminService\NguoiDungService;
use GrahamCampbell\ResultType\Success;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $user = NguoiDung::find($id);
        $users = NguoiDung::all();
        $context = [
            'users' => $users,
            'user' => $user,
        ];
        return view('admin.quanly_nguoidung.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quanly_nguoidung.new_user');
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
        $id = Auth::id();
        $user = NguoiDung::find($id);
        $context = [
            'user' => $user,
        ];
        return view('admin.quanly_nguoidung.view_info', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = NguoiDung::find($id);
        return view ('admin.quanly_nguoidung.info', compact('user')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = NguoiDung::find($id)->update($request->all());
        if($update){
            Alert::success('Cập nhật Thành Công');
            return Redirect::back();
        }else{
            Alert::error('Cập nhật Thất Bại');
            return Redirect::back();

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
        $user = NguoiDung::find($id);
        Alert::question('Bạn Có Chắc Muốn Xóa Bản Ghi Này?');
        return Redirect::back();
        if($user){
            $destroy = NguoiDung::destroy($id);
            if ($destroy){
                Alert::success('Đã Xóa Thành Công');
                return Redirect::back();
            }else{
                Alert::error('Đã Xóa Thất Bại');
                return Redirect::back();
    
            }
        }
    }
}
