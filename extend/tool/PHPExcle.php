<?php
// +----------------------------------------------------------------------
// | Time  : 15:21  2018/8/27/027
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace tool;
use think\Exception;

class  PHPExcle{
    /**
     * 获取Excel文件中的数据
     * @param $file   文件路径
     * @param $fields 表头字段名称
     * @return array
     * @throws Exception
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    static function readFile($file, $fields)
    {
        vendor('PHPExcel.PHPExcel');
        vendor('PHPExcel.PHPExcel.IOFactory.php');
        vendor('PHPExcel.PHPExcel.Reader.Excel5.php');
        $objReader = new \PHPExcel_Reader_Excel2007();
        if (!$objReader->canRead($file)) {
            $objReader = new \PHPExcel_Reader_Excel5();
            if (!$objReader->canRead($file)) {
                throw new Exception(lang('无法识别的Excle文件'));
            }
        }
        $objPHPExcel = $objReader->load($file);
        $sheet = $objPHPExcel->getSheet(0);//获取第一个工作表
        $highestRow = $sheet->getHighestRow();//取得总行数
        $highestColumn = $sheet->getHighestColumn(); //取得总列数
        /*
        if(count($fields) != $highestColumn){
            throw new Exception(lang('字段与Excel不对应'));
        }
        */
        $data = [];
        //循环读取excel文件
        for ($j = 2; $j <= $highestRow; $j++) {//从第2行开始读取数据
            $index = 0;
            for ($k = 'A'; $k <= $highestColumn; $k++) {
                $value = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();//读取单元格
                $row[$fields[$index]] = $value;
                ++$index;
            }
            $data[] = $row;
        }
        return $data;
    }

    /**
     * 导出Excel文件
     * @param $header  列标题  name=列标题名称  field=数据列中的字段名称
     * @param $data    数据集
     * @param $fileName  文件名称
     * @param $record  是否下载记录
     */
    public static function export($header, $data, $fileName,$record=false)
    {
        try{
            // 操作名称 不带时间后缀
            $actionName = $fileName;
            $fileName = $fileName.'-'.date('YmdHis',time());
            vendor('PHPExcel.PHPExcel');
            vendor('PHPExcel.PHPExcel.IOFactory');
            $objExcel = new \PHPExcel();
            // 下面这些参数没看到效果
            /*
            //创建人
            $objExcel->getProperties()->setCreator("Maarten Balliauw");
            //最后修改人
            $objExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
            //标题
            $objExcel->getProperties()->settitle("Office 2007 XLSX Test Document");
            //题目
            $objExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
            //描述
            $objExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
            //关键字
            $objExcel->getProperties()->setKeywords("office 2007 openxml php");
            //种类
            $objExcel->getProperties()->setCategory("Test result file");
            */
            //横向单元格标识
            $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

            $columns = count($header);
            $rows = count($data);
            $objExcel->getActiveSheet(0)->setTitle('sheet001');   //设置sheet名称
            $objExcel->setActiveSheetIndex(0);
            // 设置表头 第一列
            for ($i = 0; $i < $columns; $i++) {
                $objExcel->getActiveSheet()->setCellValue($cellName[$i] . '1', $header[$i]['name']);  //设置单元格内容
            }

            // 填充数据
            $index = 2; // 从第二行开始填充数据
            for ($j = 0; $j < $rows; $j++) {
                for ($i = 0; $i < $columns; $i++) {
                    $curCol = $header[$i]['field'];
                    $value = $data[$j][$header[$i]['field']];
                    // 当设置了单元格值 并且没有这个key 直接跳过
                    /*if ($value == '-') {
                        break;
                    }*/
                    // 如果需要处理图片
                    if (strpos($curCol,'image') !== false) {
                        $objExcel->getActiveSheet()->getColumnDimension($cellName[$i])->setWidth(30);
                        $objExcel->getActiveSheet()->getRowDimension($index)->setRowHeight(60);
                        /*实例化插入图片类*/
                        $objDrawing = new \PHPExcel_Worksheet_Drawing();
                        /*设置图片路径 切记：只能是本地图片*/
                        $objDrawing->setPath($value);
                        /*设置图片高度*/
                        $objDrawing->setWidth(120);
                        $img_height[] = $objDrawing->getHeight();
                        /*设置图片要插入的单元格*/
                        $objDrawing->setCoordinates($cellName[$i] . $index);
                        /*设置图片所在单元格的格式*/
                        $objDrawing->setOffsetX(0);
                        $objDrawing->setOffsetY(0);
                        $objDrawing->setRotation(0);
                        $objDrawing->getShadow()->setVisible(true);
                        $objDrawing->getShadow()->setDirection(50);
                        $objDrawing->setWorksheet($objExcel->getActiveSheet());
                    } else {
                        $objExcel->getActiveSheet()->setCellValue($cellName[$i] . $index, $value);  //设置单元格内容

                    }
                    // 判断level 设置的单元格样式
                    if (!empty($data[$j]['level'])) {
                        switch ($data[$j]['level']) {
                            case 'waring':
                                $objExcel->getActiveSheet()->getstyle($cellName[$i] . $index)->getFill()->setFillType(\PHPExcel_style_Fill::FILL_SOLID);
                                $objExcel->getActiveSheet()->getstyle($cellName[$i] . $index)->getFill()->getStartColor()->setARGB('FF808000');
                                break;
                            case 'success':
                                $objExcel->getActiveSheet()->getstyle($cellName[$i] . $index)->getFill()->setFillType(\PHPExcel_style_Fill::FILL_SOLID);
                                $objExcel->getActiveSheet()->getstyle($cellName[$i] . $index)->getFill()->getStartColor()->setARGB('FF0000FF');
                                break;
                        }
                    }
                }
                $index++;
            }
            // 冻结窗口，没效果啊
            //$objExcel->getActiveSheet()->freezePane('A2');

            //清除缓冲区,避免乱码
            ob_end_clean();

            // 如果需要记录下载历史
            if(!$record){
                //直接输出到浏览器
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
                header("Content-Type:application/force-download");
                header("Content-Type:application/ms-execl");
                header("Content-Type:application/octet-stream");
                header("Content-Type:application/download");
                header('Content-Disposition:attachment;filename="' . $fileName);
                header("Content-Transfer-Encoding:binary");
                //多浏览器下兼容中文标题
                $encoded_filename = urlencode($fileName);
                $ua = $_SERVER["HTTP_USER_AGENT"];
                if (preg_match("/MSIE/", $ua)) {
                    header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');
                } else if (preg_match("/Firefox/", $ua)) {
                    header('Content-Disposition: attachment; filename*="utf8\'\'' . $fileName . '.xls"');
                } else {
                    header('Content-Disposition: attachment; filename="' . $fileName . '.xls"');
                }
                $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel5'); //下面的用法就能解决
                $objWriter->save('php://output');
            }else{
                $objWriter = \PHPExcel_IOFactory::createWriter($objExcel, 'Excel5'); //下面的用法就能解决
                // 报表下载excel文件的存储位置
                $folder = '/public/excel/'.date('Ymd',time()).'/';
                if(!is_dir(ROOT_PATH.$folder)){
                    mkdir(ROOT_PATH.$folder,0777,true);
                }
                $path = $folder.md5(time().rand()).'.xls';
                $objWriter->save(ROOT_PATH.$path);
                $history['userId'] = session('crmUserId');
                $history['type'] = 1;
                $history['time'] = date('Y-m-d H:i:s',time());
                $history['name'] = $actionName;
                $history['file_name'] = $fileName.'.xls';
                $history['file_path'] = $path;
                model('HistoryDownload')->saveData(lang('下载').'-'.$actionName,$history);
                //直接输出到浏览器
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
                header("Content-Type:application/force-download");
                header("Content-Type:application/ms-execl");
                header("Content-Type:application/octet-stream");
                header("Content-Type:application/download");
                header('Content-Disposition:attachment;filename="' . $fileName);
                header("Content-Transfer-Encoding:binary");
                //多浏览器下兼容中文标题
                $encoded_filename = urlencode($fileName);
                $ua = $_SERVER["HTTP_USER_AGENT"];
                if (preg_match("/MSIE/", $ua)) {
                    header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');
                } else if (preg_match("/Firefox/", $ua)) {
                    header('Content-Disposition: attachment; filename*="utf8\'\'' . $fileName . '.xls"');
                } else {
                    header('Content-Disposition: attachment; filename="' . $fileName . '.xls"');
                }
                $objWriter->save('php://output');
            }
        }catch(Exception $e){
            iuboLog($e);
            echo $e->getMessage();
        }
    }
}