<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Storage;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$directory = "/public/Tasks/";
        //$files = Storage::files($directory);
        $directories = Storage::directories($directory);
        foreach ($directories as $key => $folder) {
        	$files = Storage::files($folder);
        	$fl_array = preg_grep("/[.](jpg|JPG|JPEG)$/", $files);
        	break;
        }
        foreach ($fl_array as $key => $value) {
        	$fl_array[$key] = str_replace("public/", "storage/", $value);
        }
        //$json = json_encode($fl_array);
        //var_dump($json);
        return view('frontend.index')
        	->withImageFiles($fl_array);
    }
}
