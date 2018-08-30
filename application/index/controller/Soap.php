<?php
// +----------------------------------------------------------------------
// | Time  : 19:07  2018/8/29/029
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace app\index\controller;
use think\Controller;
use tool\PHPSoap;
class Soap extends Controller{

    public function soapServer()
    {
        // 服务器验证
        if ((!empty($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER']!='fdipzone') || (!empty($_SERVER['PHP_AUTH_PW']) && $_SERVER['PHP_AUTH_PW']!='123456')) {
            header('WWW-Authenticate: Basic realm="NMG Terry"');
            header('HTTP/1.0 401 Unauthorized');
            echo "You must enter a valid login ID and password to access this resource.\n";
            exit();
        };

        $config = array(
            'uri' => 'http://newtp.test.com/index/Soap/soapServer'
        );

        $oHandle = new PHPSoap();

        // no wsdl mode
        try{
            $server = new \SOAPServer(null, $config);
            $server->setObject($oHandle);
            $server->handle();

        }catch(\SOAPFault $f){

            echo $f->faultString;

        }

    }

    public function soapClient()
    {
        $config = array(
            'location' => 'http://newtp.test.com/index/Soap/soapServer',
            'uri' => 'http://newtp.test.com/index/Soap/soapServer',
            'login' => 'fdipzone',
            'password' => '123456',
            'trace' => true
        );

        try{
            $auth = array('fdipzone', '654321');
            // no wsdl
            $client = new \SOAPClient(null, $config);
            $header = new \SOAPHeader('http://newtp.test.com/index/Soap/soapServer', 'auth', $auth, false, SOAP_ACTOR_NEXT);
            $client->__setSoapHeaders(array($header));

            $revstring = $client->revstring('123456');
            $strtolink = $client->__soapCall('strtolink', array('http://baidu.com', 'test url', 1));
            $uppcase = $client->__soapCall('uppcase', array('Hello World'));
            echo $revstring.'<br>';
            echo $strtolink.'<br>';
            echo $uppcase.'<br>';

        }catch(\SOAPFault $e){
            echo $e->getMessage();
        }

    }
}
