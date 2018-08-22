<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use bootstrap\Form;
use think\Request;

// 应用公共文件
function appLog($e)
{
    $file = $e->getFile();
    $line = $e->getLine();
    $code = $e->getCode();
    $msgs = $e->getMessage();
    $time = date('Y-m-d H:i:s');
    $message['file'] = $file;
    $message['line'] = $line;
    $message['code'] = $code;
    $message['msg'] = $msgs;
    $message['time'] = $time;
    //$message = '请求时间：' . $time . '；\n 文件：' . $file . '；\n 行号：' . $line . '；\n 错误信息：' . $msgs;
    trace($message, 'notice');
}


function formInput($name, $field, $value, $type = 'text', $rule = [], $readonly = false)
{
    Form::input($name, $field, $value, $type, $rule, $readonly);
}

function formSelect($name, $field, $value = [], $key, $keyname, $default = '')
{
    Form::select($name, $field, $value, $key, $keyname, $default);
}

function formCheck($type = 'radio', $name, $field, $values = [], $key, $keyname, $default = '')
{
    Form::check($type, $name, $field, $values, $key, $keyname, $default);
}

function formEditor($name, $field)
{
    Form::editor($name, $field);
}

function formFile($isLoad=true,$name, $field, $list = '', $values = '')
{
    $new = [];
    if($list){
        $new[] = $list;
    }
    Form::file($isLoad,$name, $field, $new, $values);
}

/**
 * 上传文件
 * @param string $folder
 * @param string $extType
 * @param int $defaultSize
 * @param bool $thumb
 * @return array
 */
function upload($folder = "default", $extType = "image", $defaultSize = 1)
{
    $folder = empty($folder) ? 'default' : $folder;
    switch ($extType) {
        case 'file':
            $accept = 'xlsx,docx,rar,zip,doc,xls,txt,ppt,pptx,pdf,jpg,jpeg,png,gif';
            break;
        default:
            $accept = 'jpg,jpeg,png,gif';
    }
    $files = request()->file();
    foreach ($files as $file){
        $fileInfo = $file->getInfo();
        $fileData['name'] = $fileInfo['name'];
        $fileData['size'] = $fileInfo['size'];
        $fileData['time'] = date('Y-m-d H:i:s');
        $info = $file->validate(['size'=>$defaultSize*1024*1024,'ext'=>$accept])->move(ROOT_PATH . '/public/resource' . DS . 'uploads'.DS.$folder);
        if($info){
            // 成功上传后 获取上传信息
            $fileData['type'] = $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $fileData['path'] = '/resource/uploads/'.$folder.'/'.str_replace('\\','/',$info->getSaveName());
            $upId = model('SystemFile')->insertGetId($fileData);
            return ['errcode'=>'0','id'=>$upId,'path'=>$fileData['path']];
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            return ['errcode'=>'20012','errmsg'=>$file->getError()];
        }
    }
}