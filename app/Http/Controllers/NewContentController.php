<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewContent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class NewContentController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if(\Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = \Auth::user(); 
            $success['token'] =  $user->createToken('NewsApp')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
        
    }

    public function index()
    {
        return view('test.news')->with(['news'=>NewContent::all(),'number_of_articals'=>$this->number_of_articals()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.test_news');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $save_news = new NewContent($request->all());
        if ($request->hasFile('file_url')) {
            $image_value = $request->file('file_url');
            $file_name = "img_".time().".".$image_value->getClientOriginalExtension(); 
            try {
               $image_value->move(public_path('images'),$file_name); 
            } catch (\Exception $e) {}            
            $save_news->file_url=$file_name;
        }
        $save_news->save();
        return redirect('/news'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('test.showdetails')->with(['news'=>NewContent::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        NewContent::destroy($id);
        return redirect('/news');
    }

    public function number_of_articals()
    {
        return NewContent::all()->count();
    }
}
