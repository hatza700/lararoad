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
        return view('backend.phan-tich-moi');
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
