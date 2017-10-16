<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/8/18
 * Time: 下午5:00
 */
namespace App\Http\Helper;

use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class SaveImage
{
    /**
     * 存储头像文件并压缩成150*150
     *
     * @param $filename
     * @param $file
     * @return string
     */
    public static function avatar($filename, $file)
    {
        $domain = \Config::get('constants.DOMAIN');
        $destinationPath = \Config::get('constants.AVATAR_SAVE_PATH');
        $suffix = '.png';
        $filename = $filename . $suffix;
        $mark = '?v=' . time(); //修改URL

        try {
            $file->move($destinationPath, $filename);
            Image::make($destinationPath . $filename)->fit(150)->save();
        } catch (\Exception $e) {
            Log::info('save-img-avatar', ['context' => $e->getMessage()]);
        }

        return $domain . '/' . $destinationPath . $filename . $mark;
    }

    /**
     * 保存认证图片
     *
     * @param $dirName
     * @param $imgFile
     * @param int $count
     * @return string
     */
    public static function auth($dirName, $imgFile, $count = 0)
    {
        $domain = \Config::get('constants.DOMAIN');
        $destinationPath = \Config::get('constants.AUTH_PATH') . $dirName . '/';
        $suffix = '.png';
        $filename = time() + $count . $suffix;
        $fullPath = $destinationPath . $filename;
        $newPath = str_replace($suffix, '_thumb' . $suffix, $fullPath);

        try {
            $imgFile->move($destinationPath, $filename);
            Image::make($fullPath)->encode('png', 30)->save($newPath); //按30的品质压缩图片
        } catch (\Exception $e) {
            Log::info('save-img-auth', ['context' => $e->getMessage()]);
        }

        return $domain . '/' . $newPath;
    }

    /**
     * 保存约诊图片
     *
     * @param $dirName
     * @param $file
     * @return string
     */
    public static function appointment($dirName, $file)
    {
        $domain = \Config::get('constants.DOMAIN');
        $destinationPath = \Config::get('constants.CASE_HISTORY_SAVE_PATH') . date('Y') . '/' . date('m') . '/' . $dirName . '/';
        $suffix = '.png';
        $filename = time() . $suffix;
        $fullPath = $destinationPath . $filename;
        $newPath = str_replace($suffix, '_thumb' . $suffix, $fullPath);

        try {
            $file->move($destinationPath, $filename);
            Image::make($fullPath)->encode('png', 30)->save($newPath); //按30的品质压缩图片
        } catch (\Exception $e) {
            Log::info('save-img-appointment', ['context' => $e->getMessage()]);
        }

        return $domain . '/' . $newPath;
    }

    /**
     * 保存上传图片
     *
     * @param $file
     * @param $destinationPath
     * @return string
     */
    public static function saveUpload($file, $destinationPath)
    {
        //文件是否上传成功
        if ($file->isValid()) {    //判断文件是否上传成功
//            $originalName = $file->getClientOriginalName(); //源文件名
//            $ext = $file->getClientOriginalExtension();    //文件拓展名
//            $type = $file->getClientMimeType(); //文件类型

//            $domain = \Config::get('constants.DOMAIN');
            $domain = '/';
//            $destinationPath = \Config::get('constants.LOGO_PATH');
            $suffix = '.png';
            $filename = date('YmdHis') . $suffix;
            $fullPath = $destinationPath . $filename;
            $newPath = str_replace($suffix, '_thumb' . $suffix, $fullPath);

            try {
                $file->move($destinationPath, $filename);
                Image::make($fullPath)->encode('png', 30)->save($newPath);
            } catch (\Exception $e) {
                Log::info('save-img-logo', ['context' => $e->getMessage()]);
            }


            return $domain . $newPath;
        } else {
            return '';
        }
    }

    /**
     * 保存广播图片
     *
     * @param $file
     * @return string
     */
    public static function radio($file)
    {
        //文件是否上传成功
        if ($file->isValid()) {    //判断文件是否上传成功
//            $originalName = $file->getClientOriginalName(); //源文件名
//            $ext = $file->getClientOriginalExtension();    //文件拓展名
//            $type = $file->getClientMimeType(); //文件类型

            $domain = \Config::get('constants.DOMAIN');
            $destinationPath = \Config::get('constants.ARTICLE_PATH');
            $suffix = '.png';
            $filename = date('YmdHis') . $suffix;
            $fullPath = $destinationPath . $filename;
            $newPath = str_replace($suffix, '_thumb' . $suffix, $fullPath);

            try {
                $file->move($destinationPath, $filename);
                Image::make($fullPath)->encode('png', 30)->save($newPath);
            } catch (\Exception $e) {
                Log::info('save-img-radio', ['context' => $e->getMessage()]);
            }


            return $domain . $newPath;
        } else {
            return '';
        }
    }
}
