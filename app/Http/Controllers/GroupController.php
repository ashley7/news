<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Account;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $groups = Group::all()->where('branch_id',\Auth::user()->branch->id);
        return view('group.list')->with(['groups'=>$groups]);
    }

 
    public function create()
    {
       return view('group.create');
    }

 
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required']);
        $save_group = new Group();
        $save_group->name = $request->name;
        $save_group->branch_id = \Auth::user()->branch->id;
        try {
            $save_group->save();
        } catch (\Exception $e) {}
        return redirect('/group');
    }
 
    public function show($id)
    {
        $group = Group::find($id);
        $accounts = Account::where('group_id',$id)->get();
        return view('accounts.list')->with(['group'=>$group,'accounts'=>$accounts]);
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
