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
    if (empty($rule)) {
        $rule = [['rule' => 'notempty']];
    }
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

function formFile($name, $field, $limit=1,$list = [], $values = '')
{
    Form::file($name, $field, $limit,$list, $values);
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
    foreach ($files as $file) {
        $fileInfo = $file->getInfo();
        $fileData['name'] = $fileInfo['name'];
        $fileData['size'] = $fileInfo['size'];
        $fileData['time'] = date('Y-m-d H:i:s');
        $info = $file->validate(['size' => $defaultSize * 1024 * 1024, 'ext' => $accept])->move(ROOT_PATH . '/public/resource' . DS . 'uploads' . DS . $folder);
        if ($info) {
            // 成功上传后 获取上传信息
            $fileData['type'] = $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $fileData['path'] = '/resource/uploads/' . $folder . '/' . str_replace('\\', '/', $info->getSaveName());
            $upId = model('SystemFile')->insertGetId($fileData);
            return ['errcode' => '0', 'errmsg'=>'文件上传成功', 'id' => $upId, 'path' => $fileData['path']];
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            // echo $info->getFilename();
        } else {
            // 上传失败获取错误信息
            return ['errcode' => '20012', 'errmsg' => $file->getError()];
        }
    }
}

/**
 * 时间字段范围
 * @param $start   input 字段
 * @param $end     input 字段
 * @param $field   表field
 * @return array
 */
function timeRange($start, $end, $field)
{
    $post = file_get_contents("php://input");
    $post = json_decode(base64_decode($post),true);
    $con = [];
    $start = !empty($post[$start]) ? $post[$start] : false;
    $end = !empty($post[$end]) ? $post[$end] : false;
    if ($start && $end) {
        if (strtotime($start) <= strtotime($end)) {
            $end = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($end)) - 1);
            $con[$field] = ['between', $start . ',' . $end];
        } else {
            $con[$field] = ['>', $start];
        }
    }elseif ($start && !$end){
        $con[$field] = ['>', $start];
    }elseif(!$start && $end){
        $con[$field] = ['<', date('Y-m-d H:i:s', strtotime('+1 day', strtotime($end)) - 1)];
    }
    return $con;
}


/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function list_to_tree($list, $pk = 'id', $pid = 'parent', $child = '_child', $root =
0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}


//获取某个分类的所有子分类
function getSubs($categorys, $filed,$pk='id',$name='name',$catId = 0, $level = 1)
{
    $subs = array();
    foreach ($categorys as $item) {
        if ($item[$filed] == $catId) {
            $item[$name] = str_repeat('|--', $level-1) . $item[$name];
            $item['level'] = $level;
            $subs[] = $item;
            $subs = array_merge($subs, getSubs($categorys,$filed, $item[$pk], $name,$level + 1));
        }
    }
    return $subs;
}