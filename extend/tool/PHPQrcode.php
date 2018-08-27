<?php
// +----------------------------------------------------------------------
// | Time  : 15:23  2018/8/27/027
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace tool;

class PHPQrcode{

    static function qrCode($url)
    {
        //加载第三方类库
        vendor('phpqrcode.phpqrcode');
        $size = 4;    //图片大小
        $errorCorrectionLevel = "Q"; // 容错级别：L、M、Q、H
        $matrixPointSize = "8"; // 点的大小：1到10
        //实例化
        $qr = new \QRcode();
        //会清除缓冲区的内容，并将缓冲区关闭，但不会输出内容。
        ob_end_clean();
        //输入二维码
        $qr::png($url, false, $errorCorrectionLevel, $matrixPointSize);
    }

    /**
     * 生成二维码图片文件
     * @param string $url  二维码链接
     * @param string $folder  保存的目录  /public 下
     * @return string    二维码路径
     */
    static function qrCodeImage($url = '',$folder='qrcode')
    {
        //加载第三方类库
        vendor('phpqrcode.phpqrcode');

        $value = $url;                  //二维码内容

        $errorCorrectionLevel = 'H';    //容错级别
        $matrixPointSize = 8;           //生成图片大小

        //生成二维码图片
        $image = time() . '.png';
        if(!is_dir(ROOT_PATH . '/public/' . $folder)){
            mkdir(ROOT_PATH . '/public/' . $folder,0777,true);
        }
        $filename = ROOT_PATH . '/public/' . $folder.'/'.$image;
        \QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        $QR = $filename;                //已经生成的原始二维码图片文件
        return $folder.'/'.$image;
    }

    //2. 在生成的二维码中加上logo(生成图片文件)
    static function qrCodeLogo($url = '',$folder='qrlogo',$logo)
    {
        //加载第三方类库
        vendor('phpqrcode.phpqrcode');
        $value = $url;                  //二维码内容
        $errorCorrectionLevel = 'H';    //容错级别
        $matrixPointSize = 8;           //生成图片大小
        //生成二维码图片
        $image = time() . '.png';
        if(!is_dir(ROOT_PATH . '/public/' . $folder)){
            mkdir(ROOT_PATH . '/public/' . $folder,0777,true);
        }
        $filename = ROOT_PATH . '/public/' . $folder.'/'.$image;
        \QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        $QR = $filename;            //已经生成的原始二维码图

        if (file_exists($logo)) {
            $QR = imagecreatefromstring(file_get_contents($QR));        //目标图象连接资源。
            $logo = imagecreatefromstring(file_get_contents($logo));    //源图象连接资源。
            $QR_width = imagesx($QR);           //二维码图片宽度
            $QR_height = imagesy($QR);          //二维码图片高度
            $logo_width = imagesx($logo);       //logo图片宽度
            $logo_height = imagesy($logo);      //logo图片高度
            $logo_qr_width = $QR_width / 4;     //组合之后logo的宽度(占二维码的1/5)
            $scale = $logo_width / $logo_qr_width;    //logo的宽度缩放比(本身宽度/组合后的宽度)
            $logo_qr_height = $logo_height / $scale;  //组合之后logo的高度
            $from_width = ($QR_width - $logo_qr_width) / 2;   //组合之后logo左上角所在坐标点
            //重新组合图片并调整大小
            /*
             *  imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
             */
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        //输出图片
        imagepng($QR, ROOT_PATH . '/public/' . $folder.'/'.'qrcode.png');
        imagedestroy($QR);
        imagedestroy($logo);
        return $folder.'/qrcode.png';
    }

}