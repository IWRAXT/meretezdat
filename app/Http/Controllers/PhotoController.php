<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{

    public function uploadImage(Request $request)
    {

        if ($request->hasFile('file')) {
            $photo = new Photo();
            $photo->name = $request->file('file')->getClientOriginalName();

            $path = $request->file('file')->storeAs('public/images', $photo->name);
//            Image::make(storage_path('app/'.$path))
//                ->resize(100, 100)
//                ->save();

            //  $img = Image::make($path)->resize(100, 100)->save();
            //return $request->foto->extension();   --Megadja a file kiterjesztését
            //return Storage::putFile('public',$request->file('foto')); --upload1
            // $request->foto->storeAs('public/images','ponty.jpg');  //--upload2
            //$request->foto->storeAs('public/images', 'pontyresize.jpg'); //--upload3 -ponty-néven
            //$url=Storage::url('ponty.jpg');

            $name = $request->file('file')->getClientOriginalName();
            $photo->save();
//           return response('ok',200)->json([$name]);
            return response($name);
        } else {
            return redirect('/')->with('success', 'Nincs file kiválasztva');
        }
    }

    public function huszonot(Request $request)
    {

        if ($request->input('file') !== null) {
            dd($request->file('file'));
            $filename = $request->file('file')
                ->getClientOriginalName();

            $img = Image::make(storage_path('app/public/images' .
                $filename));
            $size = $img->filesize();
            $img->resize($size * 0.25, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
            $photo = Photo::where('name', $filename)->first();
            $photo->move(public_path('images'), $filename);
            $photo->name = $filename;
            return response('ok', 200)->json(['success' => 'Átméretezve']);
        } else {
            return response($request->all());
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
