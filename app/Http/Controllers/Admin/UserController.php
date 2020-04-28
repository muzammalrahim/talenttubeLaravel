<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(){
    	$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['title'] = 'Users';
        $data['content_header'] = 'Users List';
        return view('admin.user.list', $data);
    }

    public function employers() {
        $data['title'] = 'Employers';
        $data['content_header'] = 'Employers List';
        return view('admin.employer.list', $data);
    }


    /** ================ This method returns the datatables data to view ================ */
    public function getDatatable(){
      $records = array();
      $records = User::select(['id', 'name', 'email', 'created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'user'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('users.edit',['id' =>$records->id]).'">'.__('common.edit').'</a>';
            return $rhtml;
        }
      })
      ->toJson();
    }

    /** ================ This method returns the datatables data to view ================ */
    public function getEmployerDatatable(){
      $records = array();
      $records = User::select(['id', 'name', 'email', 'created_at'])
        ->whereHas('roles' , function($q){ $q->where('slug', 'employer'); })
        ->orderBy('created_at', 'desc');
      return datatables($records)
      ->addColumn('action', function ($records) {
        if (isAdmin()){
            $rhtml = '<a href="'.route('employers.edit',['id' =>$records->id]).'">'.__('common.edit').'</a>';
            return $rhtml;
        }
      })
      ->toJson();
    }


    /** ================   ================ */
    public function create(){
        $data['record']   = FALSE;
        $data['title']  = 'User';
        $data['content_header'] = 'Add new User';
        return view('admin.user.edit', $data);
    }

    /** ================   ================ */
    public function edit(User $id){
        $data['record']   = $id;
        $data['title']  = 'User';
        $data['content_header'] = 'Add new User';
        return view('admin.user.edit', $data);
    }

    /** ================  ================ */
    public function editEmployer(User $id){
        $data['record']   = $id;
        $data['title']  = 'Employer';
        $data['content_header'] = 'Edit Employer';
        return view('admin.employer.edit', $data);
    }



    public function storeEmployer(Request $request){

    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if (!$user){
            return redirect(route('users'))->withErrors(['token' => 'User with id '.$id.' does not exist']);
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if( $user->save() ){
            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }


    public function updateEmployer(Request $request, $id){

    }


    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email',
            'password' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if( $user->save() ){

            $user->roles()->attach([config('app.user_role')]);

            return redirect(route('users'))->withSuccess( __('admin.record_updated_successfully'));
        }
    }




    public function show($id){

    }











    public function destroy($id)
    {

    }
}
