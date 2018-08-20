<?php
namespace app\index\controller;
use quickCard180818\Pay as qkPay;
use think\Request;
use bootstrap\Form;
class Index
{
    public function index()
    {
        Form::input('姓名','name','text',[
            ['rule'=>'notempty'],
            ['rule'=>'stringlength','min'=>10,'max'=>'20'],
            ['rule'=>'identical','name'=>'不知奥','field'=>'userrss'],
            ['rule'=>'emailaddress'],
            ['rule'=>'date'],
            ['rule'=>'digits'],
        ]);
    }
}
