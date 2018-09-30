<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\User;

class BranchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $branch = Branch::all()->where('name','!=','Setup');
        return view('branch.list')->with(['branch'=>$branch]);
    }


    public function create()
    {
          return view('branch.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required','admin_name'=>'required','email'=>'required','phone_number'=>'required']);
        $save_branch = new Branch();
        $save_branch->name = $request->name;
        $save_branch->location = $request->location;
        $save_branch->save();

        $save_user = new User();
        $save_user->name = $request->admin_name;
        $save_user->email = $request->email;
        $save_user->password = bcrypt($request->phone_number);
        $save_user->branch_id = $save_branch->id;
        $save_user->phone_number = $request->phone_number;
        try {
            $save_user->save();
            try {
                $readrole=\DB::table('roles')->where('name','manager')->select('id')->first();
                \DB::table('role_user')->insert([['user_id' => $save_user->id, 'role_id' =>  $readrole->id],]);            
            } catch (\Exception $e) {}

        } catch (\Exception $e) {}
        return redirect('/home')->with(['status'=>'Operation successfull']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
