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

            //  $img = Image::make($path)->resize(100, 100)->save();
            //return $request->foto->extension();   --Megadja a file kiterjesztését
            //return Storage::putFile('public',$request->file('foto')); --upload1
            // $request->foto->storeAs('public/images','ponty.jpg');  //--upload2
            //$request->foto->storeAs('public/images', 'pontyresize.jpg'); //--upload3 -ponty-néven
            //$url=Storage::url('ponty.jpg');

            $name = $request->file('file')->getClientOriginalName();
            $photo->save();
            return response($name);
        } else {
            return redirect('/')->with('success', 'Nincs file kiválasztva');
        }
    }

//    public function huszonot(Request $request)
//    {
//        if ($request->hasFile('file')) {
//
//            $filename = $request->file('file')->getClientOriginalName();
//            $photo = Photo::where('name', $filename)->first();
//            $img = Image::make(file_get_contents(request()->file('file')));
//
////            $img=Image::make( request()->file('file'));  //Ez simán nem működik
//
//            $width = $img->width();
//
//            $img->resize($width * 0.25, null, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save(storage_path('app/public/images/' . $filename));
//
//
//            $photo->name = $filename;
//            return response('ok', 200);
//        } else {
//            return response($request->all());
//        }
//    }

    public function meretez(Request $request)
    {
        if ($request->hasFile('file')) {

            $filename = $request->file('file')->getClientOriginalName();
            $photo = Photo::where('name', $filename)->first();
            $img = Image::make(file_get_contents(request()->file('file')));

//            $img=Image::make( request()->file('file'));  //Ez simán nem működik

            $width = $img->width();
            $szam = ($request->meret) / 100;

            if ($request->radio === true) {
                $img->resize($width * $szam, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img->resize($width * $szam, null);
            }

            $img->save(storage_path('app/public/images/' . $filename));


            $photo->name = $filename;
            return response('ok', 200);
        } else {
            return response($request->all());
        }
    }

    public
    function jpg(Request $request)
    {

        if ($request->hasFile('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $photo = Photo::where('name', $filename)->first();
            $img = Image::make(file_get_contents(request()->file('file')));

            $dotPos = strpos($filename, ".");
            $filename = substr($filename, 0, $dotPos);

            $img->save(storage_path('app/public/images/' . $filename . '.jpg'));

            $photo->name = $filename . '.jpg';

//            strlen()	Returns the length of a string
//            strrchr()	Finds the last occurrence of a string inside another string
//            The substr() function returns a part of a string.
//


            return response()->download(storage_path('app/public/images/' . $filename . '.jpg'), $filename . '.jpg',
                [
                    "Content-Description: File Transfer",
                    "Content-Transfer-Encoding: Binary"
                ]);
        } else {
            return response($request->all());
        }
    }

    public
    function png(Request $request)
    {

        if ($request->hasFile('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $photo = Photo::where('name', $filename)->first();
            $img = Image::make(file_get_contents(request()->file('file')));

            $dotPos = strpos($filename, ".");
            $filename = substr($filename, 0, $dotPos);

            $img->save(storage_path('app/public/images/' . $filename . '.png'));

            $photo->name = $filename . '.png';


            return response()->download(storage_path('app/public/images/' . $filename . '.png'), $filename . '.png', ["Content-Description: File Transfer",
                ("Content-Transfer-Encoding: Binary")]);
        } else {
            return response($request->all());
        }
    }


    public
    function show($id)
    {
        //
    }

    public
    function edit($id)
    {
        //
    }

    public
    function update(Request $request, $id)
    {
        //
    }

    public
    function destroy($id)
    {
        //
    }
}
