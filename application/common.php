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
    $message = '请求时间：'.$time.'；\n 文件：'.$file.'；\n 行号：'.$line.'；\n 错误信息：'.$msgs;
    trace($message,'notice');
}


function formInput($name,$field,$value,$type='text',$rule=[],$readonly=false)
{
    Form::input($name,$field,$value,$type,$rule,$readonly);
}

function formSelect($name, $field,$value=[], $key, $keyname, $default = '')
{
    Form::select($name, $field,$value,$key,$keyname,$default);
}

function formCheck($type='radio',$name, $field, $values = [], $key, $keyname, $default = '')
{
    Form::check($type,$name, $field, $values, $key, $keyname, $default);
}

function formEditor($name, $field)
{
    Form::editor($name, $field);
}