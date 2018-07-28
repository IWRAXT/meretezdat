<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->hasFile('foto')) {

            $photo=new Photo();
            $photo->name='ponty.jpg';

            $path = $request->file('foto')->storeAs('public/images', $photo->name);
            $img = Image::make(storage_path('app/'.$path))
                ->resize(100, 100)
                ->save();


            //  $img = Image::make($path)->resize(100, 100)->save();

            //return $request->foto->extension();   --Megadja a file kiterjesztését
            //return Storage::putFile('public',$request->file('foto')); --upload1
            // return

            // $request->foto->storeAs('public/images','ponty.jpg');  //--upload2
            //$request->foto->storeAs('public/images', 'pontyresize.jpg'); //--upload3 -ponty-néven


            //$url=Storage::url('ponty.jpg');
            //dd($img);

            $photo->save();
            return view('welcome');
        } else {
            return redirect('/')->with('success','Nincs file kiválasztva');
        }


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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
