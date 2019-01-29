<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use ZipArchive;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Input;

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

    public function phanTichMoi(Request $request, string $folder = "")
    {
        $directory = "/public/Tasks/";
        
        if ($request->has('images_location')) {
            $zip_file = $request->file('images_location');            
            $zip_file_path = public_path("storage/".$zip_file->store('/Tasks', 'public'));
            $zip = new ZipArchive;
            $is_open = $zip->open($zip_file_path);            
            if ($is_open === true) {
                $destination = storage_path("app/".$directory);
                $zip->extractTo($destination);
                $zip->close();
                $folder = str_replace(".zip", "", $zip_file->getClientOriginalName());
                return redirect()->route('admin.thuc-hien-phan-tich', ['folder' => $folder]);
            }
        } 

        $directories = Storage::directories($directory);
        $fl_array = array();
        foreach ($directories as $key => $fol) {
            $items = explode('_', $fol);
            $folder_names = explode('/', $fol, 3);
            $directories[$key] = $folder_names[2];
            if ($folder_names[2] === $folder || ($key == count($directories)-1 && empty($fl_array))) {
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
            $road['action_buttons'] ='<a href="'.route('admin.phan-tich-moi', $folder_names[2]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>'.
            '<a href="'.route('admin.phan-tich', $folder_names[2]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info">Chi tiết</a>';
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
        $fl_array = array();
        $folder1 = $folder;
        foreach ($directories as $key => $fol) {
            $items = explode('_', $fol);
            $folder_names = explode('/', $fol, 3);
            $directories[$key] = $folder_names[2];
            if ($folder_names[2] === $folder || ($key == count($directories)-1 && empty($fl_array))) {
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

        $process = new Process('python ../crack_predict3.py --model ../ml_model/Model_new_5.h5 --image_path '.str_replace("public/", "storage/", $folder));
        $process->setTimeout(36000);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        echo $process->getOutput();

        return redirect()->route('admin.phan-tich-moi', ['folder' => $folder1]);
    }

    public function phanTich(Request $request, string $folder = "", int $page = 0)
    {
        $org_foler = $folder;

        if ($request->isMethod('post')) {
            $input = $request->input();
            if(isset($input['goto'])) {
                return redirect()->route('admin.phan-tich', ['folder' => $org_foler, 'page' => $input['new_page']]);
            }
            if(isset($input['prev'])){
                $new_page = $input['prev'];
                if ($new_page < 0)
                    $new_page = 0;
                return redirect()->route('admin.phan-tich', ['folder' => $org_foler, 'page' => $new_page]);
            }
        }

        $directory = "/public/Tasks/";
        
        $directories = Storage::directories($directory);
        $fl_array = array();
        foreach ($directories as $key => $fol) {
            $items = explode('_', $fol);
            $folder_names = explode('/', $fol, 3);
            $directories[$key] = $folder_names[2];
            if ($folder_names[2] === $folder || ($key == count($directories)-1 && empty($fl_array))) {
                $files = Storage::files($fol);
                $fl_array = preg_grep("/[.](jpg|JPG|JPEG)$/", $files);
                $folder = $fol;
                $folder_key = $key;
            }
        }

        $ii = 0;
        $fl_array1 = array();
        $list_array = array();
        $pages = array();
        rsort($fl_array);
        //var_dump($fl_array); die;
        foreach ($fl_array as $key => $value) {
            if (Storage::exists($value.".list.json"))
                $list_json = Storage::get($value.".list.json");
            else
                $list_json = null;
            $list_array[$ii] = json_decode($list_json, true);
            $fl_array1[$ii] = str_replace("public/", "storage/", $value);
            if ($ii % 3 == 0)
                $pages[] = "Trang ".($ii/3+1);
            $ii++;
        }

        if ($request->isMethod('post')) {
            $input = $request->input();

            if(isset($input['next'])){
                $new_page = $input['next'];
                if ($new_page >= count($pages))
                    $new_page = count($pages)-1;
                return redirect()->route('admin.phan-tich', ['folder' => $org_foler, 'page' => $new_page]);
            }
        }

        
        $img_total = count($fl_array1);
        $page_total = intdiv($img_total, 3);
        $img_num1 = $page*3;
        $img_num2 = $img_num1 + 2;
        if ($img_num2 > $img_total)
            $img_num2 = $img_total;


        $fl_array = array_slice($fl_array1, $img_num1, $img_num2-$img_num1+1);
        $list_array = array_slice($list_array, $img_num1, $img_num2-$img_num1+1);

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
        
        return view('backend.phan-tich')
            ->withRoad($road)
            ->withDirectories($directories)
            ->withFolderKey($folder_key)
            ->withImageFiles($fl_array)
            ->withImgNum1($img_num1)
            ->withImgNum2($img_num2)
            ->withListArray($list_array)
            ->withPages($pages)
            ->withPage($page);
    }

}
