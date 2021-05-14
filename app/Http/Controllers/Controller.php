<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function LoadView($view_path)
    {
        View::composer($view_path, function ($view) {
            $view->with('data', $this->data);
            $view->with('base_view', $this->base_view);
        });
        return $view_path;
    }

    public function UploadFile($path, $file)
    {
        $now = Carbon::now();
        $original_name = $file->getClientOriginalName();
        $folder = $now->format('M').$now->year;
        $name = $original_name.'.'.$file->extension();
        $file_path = $path.'/'.$folder;
        $path = $file->storeAs($file_path, $name);
        return $path;
    }

    public function UploadEditorImage(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('editor-images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('editor-images/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function LogActivity($message)
    {
        activity()->disableLogging();
        $lastActivity = Activity::all()->last();
        if($lastActivity){
            $lastActivity->description = $message;
            $lastActivity->save();
        }
        activity()->enableLogging();

    }
}
