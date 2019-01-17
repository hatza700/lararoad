<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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

    public function phanTichMoi(string $folder = "")
    {
        $directory = "/public/Tasks/";
        //$files = Storage::files($directory);
        $directories = Storage::directories($directory);
        foreach ($directories as $key => $fol) {
            $items = explode('_', $fol);
            $folder_names = explode('/', $fol, 3);
            $directories[$key] = $folder_names[2];
            if ($folder_names[2] == $folder || $key == count($directories)-1) {
                $files = Storage::files($fol);
                $fl_array = preg_grep("/[.](jpg|JPG|JPEG)$/", $files);
                $folder = $fol;
                $folder_key = $key;
            }
        }
        $ii = 0;
        $fl_array1 = array();
        foreach ($fl_array as $key => $value) {
            $fl_array1[$ii] = str_replace("public/", "storage/", $value);
            $ii++;
        }
        $fl_array = $fl_array1;
        $roads = array();
        $road['ma_loai_duong'] = substr($items[1], 0, 1);
        $road['ma_tuyen_duong'] = substr($items[1], 1, 3);
        $road['ma_tuyen_nhanh'] = substr($items[1], 4, 2);
        $road['ma_thu_tu_lan'] = substr($items[2], 0);
        $road['nam_khao_sat'] = substr($items[3], 0, 4);
        $kp_contents = Storage::get($folder.'/'.'KP_LIST.CSV');
        $lines = explode(PHP_EOL, $kp_contents);
        $csv1 = str_getcsv($lines[0]);
        $csv2 = str_getcsv($lines[1]);
        $arr = array_combine($csv1, $csv2);
        $road['chieu_duong'] = $arr['UpDown'];
        $road['chieu_dai'] = $arr['To']-$arr['From'];
        
        return view('backend.phan-tich-moi')
            ->withRoad($road)
            ->withDirectories($directories)
            ->withFolderKey($folder_key)
            ->withImageFiles($fl_array);
    }

    public function dsPhanTich()
    {
        $directory = "/public/Tasks/";
        $directories = Storage::directories($directory);
        $roads = array();
        foreach ($directories as $key => $folder) {
            $items = explode('_', $folder);
            $folder_names = explode('/', $folder, 3);
            $road['ma_loai_duong'] = substr($items[1], 0, 1);
            $road['ma_tuyen_duong'] = substr($items[1], 1, 3);
            $road['ma_tuyen_nhanh'] = substr($items[1], 4, 2);
            $road['ma_thu_tu_lan'] = substr($items[2], 0);
            $road['nam_khao_sat'] = substr($items[3], 0, 4);
            $kp_contents = Storage::get($folder.'/'.'KP_LIST.CSV');
            $lines = explode(PHP_EOL, $kp_contents);
            $csv1 = str_getcsv($lines[0]);
            $csv2 = str_getcsv($lines[1]);
            $arr = array_combine($csv1, $csv2);
            $road['chieu_duong'] = $arr['UpDown'];
            $road['chieu_dai'] = $arr['To']-$arr['From'];
            $road['action_buttons'] ='<a href="'.route('admin.phan-tich-moi', $folder_names[2]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>';
            $roads[] = $road;
        }
        return view('backend.ds-phan-tich')
            ->withRoads($roads);
    }

    public function thucHienPhanTich(string $folder = "")
    {
        $directory = "/public/Tasks/";
        //$files = Storage::files($directory);
        $directories = Storage::directories($directory);
        foreach ($directories as $key => $fol) {
            $items = explode('_', $fol);
            $folder_names = explode('/', $fol, 3);
            $directories[$key] = $folder_names[2];
            if ($folder_names[2] == $folder || $key == count($directories)-1) {
                $files = Storage::files($fol);
                $fl_array = preg_grep("/[.](jpg|JPG|JPEG)$/", $files);
                $folder = $fol;
                $folder_key = $key;
            }
        }
        $ii = 0;
        $fl_array1 = array();
        foreach ($fl_array as $key => $value) {
            $fl_array1[$ii] = str_replace("public/", "storage/", $value);            
            $ii++;
        }

        $process = new Process('python ../crack_predict.py --model ../ml_model/Model_new_5.h5 --image_path '.str_replace("public/", "storage/", $folder));
        $process->setTimeout(36000);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        echo $process->getOutput();

        $fl_array = $fl_array1;
        $roads = array();
        $road['ma_loai_duong'] = substr($items[1], 0, 1);
        $road['ma_tuyen_duong'] = substr($items[1], 1, 3);
        $road['ma_tuyen_nhanh'] = substr($items[1], 4, 2);
        $road['ma_thu_tu_lan'] = substr($items[2], 0);
        $road['nam_khao_sat'] = substr($items[3], 0, 4);
        $kp_contents = Storage::get($folder.'/'.'KP_LIST.CSV');
        $lines = explode(PHP_EOL, $kp_contents);
        $csv1 = str_getcsv($lines[0]);
        $csv2 = str_getcsv($lines[1]);
        $arr = array_combine($csv1, $csv2);
        $road['chieu_duong'] = $arr['UpDown'];
        $road['chieu_dai'] = $arr['To']-$arr['From'];
        
        return view('backend.phan-tich-moi')
            ->withRoad($road)
            ->withDirectories($directories)
            ->withFolderKey($folder_key)
            ->withImageFiles($fl_array);
    }


}
