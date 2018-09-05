<?php
// +----------------------------------------------------------------------
// | Time  : 15:26  2018/8/27/027
// +----------------------------------------------------------------------
// | Author: whlphper  备注:
// +----------------------------------------------------------------------
namespace tool;
class PHPEmail{

    private $config = [
        'siteName' => '汇众商城',
        'host' => 'smtp.163.com',
        'username' => 'whlphper1994@163.com',
        'password' => 'whlphper1994',
        'ssl' => 'ssl',
        'port' => '994',
    ];

    /**
     * 邮件配置
     * SysEmail constructor.
     * @param array $data
     */
    function __construct($data = [])
    {
        $this->config = array_merge($this->config,$data);

    }


    function myEmail($email,$theme,$content)
    {
        try {
            $toemail = $email;//定义收件人的邮箱
            import('PHPMailer.PHPMailer', VENDOR_PATH);
            import('PHPMailer.SMTP', VENDOR_PATH);
            $mail = new \PHPMailer();
            $siteName = $this->config['siteName'];
            $mail->isSMTP();// 使用SMTP服务
            $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
            $mail->Host = $this->config['host'];// 发送方的SMTP服务器地址
            $mail->SMTPAuth = true;// 是否使用身份验证
            $mail->Username = $this->config['username'];// 发送方的QQ邮箱用户名，就是自己的邮箱名
            $mail->Password = $this->config['password'];// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
            $mail->SMTPSecure = $this->config['ssl'];// 使用ssl协议方式,
            $mail->Port = $this->config['port'];// QQ邮箱的ssl协议方式端口号是465/587
            $mail->setFrom("whlphper1994@163.com", $siteName);// 设置发件人信息，如邮件格式说明中的发件人,
            $mail->addAddress($toemail, '');// 设置收件人信息，如邮件格式说明中的收件人
            //$mail->addReplyTo("xxxxx@qq.com","Reply");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
            //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
            //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
            //$mail->addAttachment("bug0.jpg");// 添加附件
            $mail->Subject = $siteName . "-" . $theme;// 邮件标题
            $body = $content;
            $mail->Body = $body;// 邮件正文
            $mail->IsHTML(true);
            if (!$mail->send()) {// 发送邮件
                throw new \Exception("Mailer Error: " . $mail->ErrorInfo);
            } else {
                return ['errcode' => '0', 'errmsg' => lang('邮箱发送成功')];
            }
        } catch (\Exception $E) {
            return ['errcode' => '12594', 'msg' => $E->getMessage()];
        }
    }
}