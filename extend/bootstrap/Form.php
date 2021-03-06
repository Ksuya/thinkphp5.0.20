<?php
// +----------------------------------------------------------------------
// | 表单生成器 包括验证器，以及验证消息 验证格式
// +----------------------------------------------------------------------
// | Time  : 16:30  2018/8/20/020
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace bootstrap;
use think\Request;
class Form
{

    private static $prefix = 'data-bv-';

    public static function input($name, $field, $value = '', $type = 'text', $rules = [], $readonly = false)
    {
        $header = '<div class="form-group"><label for="' . md5($field) . '" class="col-sm-2 control-label">' . $name . '</label><div class="col-sm-4">';
        $valiHtml = self::vendor($rules,$name);
        if ($readonly) {
            $read = 'readonly="readonly"';
        } else {
            $read = '';
        }
        if($type == 'date'){
            $class = 'datepicker';
            $type = 'text';
        }else{
            $class = '';
        }
        $footer = '<input type="' . $type . '" class="form-control '.$class.'" data-bv-trigger="change" id="' . md5($field) . '" name="' . $field . '" ' . $valiHtml . ' ' . $read . ' value="' . $value . '" placeholder="请填写' . $name . '"  /></div></div>';
        echo $header . $footer;
    }

    public static function select($name, $field, $values = [], $key, $keyname, $default = '',  $rules = [['rule' => 'notempty']], $readonly = false)
    {
        $header = '<div class="form-group"><label for="' . md5($field) . '" class="col-sm-2 control-label">' . $name . '</label><div class="col-sm-4">';
        $valiHtml = self::vendor($rules,$name);
        if ($readonly) {
            $read = 'disabled="disabled"';
        } else {
            $read = '';
        }
        $footer = '<select  class="form-control" data-bv-trigger="change" id="' . md5($field) . '" name="' . $field . '" ' . $valiHtml . ' ' . $read . '>';
        $footer .= '<option value="">请选择</option>';
        if ($key && $keyname) {
            foreach ($values as $v) {
                $isDefault = $v[$key] === $default;
                if ($isDefault) {
                    $footer .= '<option value="' . $v[$key] . '" selected="selected">' . $v[$keyname] . '</option>';
                } else {
                    $footer .= '<option value="' . $v[$key] . '">' . $v[$keyname] . '</option>';
                }
            }
        } else {
            foreach ($values as $k => $v) {
                $isDefault = $k === $default;
                if ($isDefault) {
                    $footer .= '<option value="' . $k . '" selected="selected">' . $v . '</option>';
                }else{
                    $footer .= '<option value="' . $k . '">' . $v . '</option>';
                }
            }
        }
        $footer .= '</select></div></div>';
        echo $header . $footer;
    }

    public static function check($type='radio',$name, $field, $values = [], $key, $keyname, $default = '',  $rules = [['rule' => 'notempty']], $readonly = false)
    {
        $header = '<div class="form-group"><label  class="col-sm-2 control-label">' . $name . '</label><div class="col-sm-3">';
        $valiHtml = self::vendor($rules,$name);
        if ($readonly) {
            $read = 'disabled="disabled"';
        } else {
            $read = '';
        }
        if($type == 'checkbox'){
            $default = explode(',',$default);
        }
        $footer = '';
        if ($key && $keyname) {
            foreach ($values as $v) {
                if($type == 'radio'){
                    $isDefault = $v[$key] == $default;
                }else{
                    $isDefault = in_array($v[$key],$default);
                }
                if ($isDefault) {
                    $footer .= '<label class="radio-inline">
                                    <input type="'.$type.'" name="'.$field.'"  value="'.$v[$key].'" checked="checked" '.$valiHtml.'>'.$v[$keyname].'
                                </label>';
                } else {
                    $footer .= '<label class="radio-inline">
                                    <input type="'.$type.'" name="'.$field.'"  value="'.$v[$key].'" '.$valiHtml.'>'.$v[$keyname].'
                                </label>';
                }
            }
        } else {
            foreach ($values as $k => $v) {
                if($type == 'radio'){
                    $isDefault = $v[$key] == $default;
                }else{
                    $default = explode(',',$default);
                    $isDefault = in_array($v[$key],$default);
                }
                if ($isDefault) {
                    $footer .= '<label class="radio-inline">
                                    <input type="'.$type.'" name="'.$field.'"  value="'.$k.'" checked="checked" '.$valiHtml.'>'.$v.'
                                </label>';
                }else{
                    $footer .= '<label class="radio-inline">
                                    <input type="'.$type.'" name="'.$field.'"  value="'.$k.'" '.$valiHtml.'>'.$v.'
                                </label>';
                }
            }
        }
        $footer .= '</div></div>';
        echo $header . $footer;
    }

    public static function editor($name, $field,$rules = [['rule' => 'notempty']])
    {
        $valiHtml = self::vendor($rules,$name);
        $html = '<div class="form-group">
                            <label class="col-sm-2 control-label">'.$name.'</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="'.$field.'" name="'.$field.'" '.$valiHtml.' data-bv-trigger="change"></textarea>
                            </div>
                        </div>';
        $html .= '<script type="text/javascript" src="/static/vendor/ckeditor/ckeditor.js"></script>';
        $url = url('Login/ajaxUpload');
        $html .= '<script type="text/javascript">CKEDITOR.replace("'.$field.'",{
            filebrowserImageUploadUrl : "'.$url.'",
        });</script>';
        echo $html;
    }

    public static function vendor(array $rules,$fName='',$isfile=false)
    {
        if (empty($rules)) {
            return;
        }
        $html = '';
        foreach ($rules as $type) {
            $cur = '';
            $valiType = $type['rule'];
            $cur .= self::$prefix . $valiType . '="true" ';
            switch ($valiType) {
                case 'notempty':
                    $tag = $isfile ? '请上传' : '请填写';
                    $msg = $tag.$fName;
                    break;
                case 'stringlength':
                    $min = empty($type['min']) ? 6 : $type['min'];
                    $max = empty($type['max']) ? 6 : $type['max'];
                    $msg = '字符长度' . '在 ' . $min . '~ ' . $max . ' 之间"';
                    $cur .= self::$prefix . $valiType . '-min=' . $min . ' ' . self::$prefix . $valiType . '-max=' . $max;
                    break;
                case 'identical':
                    $name = $type['name'];
                    $field = $type['field'];
                    $cur .= self::$prefix . $valiType . '-field=' . $field;
                    $msg = '和' . $name . '不一样';
                    break;
                case 'emailaddress':
                    $msg = '请填写有效电子邮箱';
                    break;
                case 'date':
                    $cur .= self::$prefix . $valiType . '-format="YYYY-MM-DD"';
                    $msg = '请填写有效时间';
                    break;
                case 'digits':
                    $msg = '请填写有效数字';
                    break;
                case 'choice':
                    $min = empty($type['min']) ? 1 : $type['min'];
                    $max = empty($type['max']) ? 99 : $type['max'];
                    $cur .= self::$prefix . $valiType . '-min=' . $min . ' ' . self::$prefix . $valiType . '-max=' . $max;
                    break;
                default:
                    $cur = '';

            }
            $cur .= ' ' . self::$prefix . $valiType . '-message="' . $msg . '"';
            $html .= ' ' . $cur;
        }
        return $html;
    }

    public static function file($name,$field,$limit=1,$list=[],$values='',$rules=[['rule' => 'notempty']])
    {
        $valiHtml = self::vendor($rules,$name,true);
        $html = '<div class="form-group">
                            <label class="control-label col-sm-2">'.$name.':</label>
                             <div class="col-sm-4">
            <input class="form-control" id="'.md5($field).'" data-url="'.url('/manager/login/fileInputUpload').'" data-limit="'.$limit.'" data-id="'.$field.'" data-preview="'.$field.'-preview" type="file" style="opacity: 0;height: 0;width: 0;" onchange="reayUpload($(this));">
            <input type="hidden" id="'.$field.'" value="'.$values.'" '.$valiHtml.' name="'.$field.'" data-bv-trigger="change"/>
            <button class="btn btn-info" type="button" onclick="$(\'input[id='.md5($field).']\').click();">点击上传</button><small></small>
        </div><div class="col-sm-8 file-preview" id="'.$field.'-preview">';
        foreach ($list as $v){
            $id = md5(time());
            $html .= '<div class="col-sm-3">
            <img src="'.$v.'" id="'.$id.'" class="img-responsive">
            <span title="删除图片" class="remove-file"  onclick="removePreview($(this),\''.$id.'\',\''.$field.'\');">x</span>
            </div>';
        }
        $html .= '</div></div>';
        echo $html;
    }


}