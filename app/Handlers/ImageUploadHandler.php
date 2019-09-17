<?php
/**
 * 图片上传类
 */

namespace App\Handlers;
use Illuminate\Support\Str;

class ImageUploadHandler
{
    //只允许上传以下后缀名的图片文件上传
    protected $allowed_ext = ["png","jpg","git","jpeg"];

    /**
     * 文件上传
     * @param $file         上传文件信息
     * @param $folder       上传文件字段名（用于区分）
     * @param $file_prefix  上传图片关联的id
     * @return array|bool
     */
    public function save($file,$folder,$file_prefix)
    {
        //构建文件存储的文件夹规则，值如uploads/images/avatars/201909/17
        $folder_name = "uploads/images/$folder/".date("Ym/d",time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path().'/'.$folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix."_".time()."_".Str::random(10).".".$extension;

        //如果不是图片将终止操作
        if (!in_array($extension,$this->allowed_ext)) {
            return FALSE;
        }

        //将图片移动到我们的目标存储路径中
        $file->move($upload_path,$filename);

        return ['path' => config('app.url')."/$folder_name/$filename"];

    }

}
