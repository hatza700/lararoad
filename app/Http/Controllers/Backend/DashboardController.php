<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Storage;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    public function phanTichMoi()
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
        return view('backend.phan-tich-moi')->withImageFiles($fl_array);;
    }

    public function dsPhanTich()
    {
        $directory = "/public/Tasks/";
        $files = Storage::files($directory);
        $directories = Storage::directories($directory);
        return view('backend.ds-phan-tich')
            ->withFiles($files)
            ->withDirectories($directories);
    }
}
