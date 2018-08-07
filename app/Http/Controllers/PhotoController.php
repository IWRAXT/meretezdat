<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function uploadImage(Request $request)
    {
//        $image->move(public_path('images'),$imageName);


        if ($request->hasFile('file')) {

            $photo=new Photo();
            $photo->name=$request->file('file')->getClientOriginalName();

            $path = $request->file('file')->storeAs('public/images', $photo->name);
//            Image::make(storage_path('app/'.$path))
//                ->resize(100, 100)
//                ->save();


            //  $img = Image::make($path)->resize(100, 100)->save();

            //return $request->foto->extension();   --Megadja a file kiterjesztését
            //return Storage::putFile('public',$request->file('foto')); --upload1
            // return

            // $request->foto->storeAs('public/images','ponty.jpg');  //--upload2
            //$request->foto->storeAs('public/images', 'pontyresize.jpg'); //--upload3 -ponty-néven


            //$url=Storage::url('ponty.jpg');
            //dd($img);
            $name = $request->file('file')->getClientOriginalName();
            $photo->save();
//           return response('ok',200)->json([$name]);
            return response($name);
        } else {
            return redirect('/')->with('success','Nincs file kiválasztva');
        }


    }



//    public function upload(Request $request)
//    {
//
//        if ($request->hasFile('file')) {
//
//            $photo=new Photo();
//            $photo->name=$request->file('file')->getClientOriginalName();
//            $path = $request->file('file')->storeAs('public/images', $photo->name);
//            Image::make(storage_path('app/'.$path))
//                ->resize(100, 100)
//                ->save();
//            $photo->save();
//
//            return response()->json(['success'=>$photo->name]);
//
//        } else {
//            return redirect('/')->with('success','Nincs file kiválasztva');
//        }
//
//    }


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
