<?php

namespace jumdata;


/**
 * 短信SDK
 */
class Sms {

    protected $userName = null;
    protected $password = null;
    protected $httpGateway = null;
    // 调试模式
    protected $debug = false;
    /**
     * 请求客户端
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;


    /**
     * @param string $userName 账号
     * @param string $password 密码
     * @param string $httpGateway 网关, 默认 http://119.23.144.191:8001/sms/,  结尾必须带 "/sms/"
     * @param boolean $debug
     */
    public function __construct(string $userName='', string $password='', string $httpGateway = 'http://119.23.144.191:8001/sms/', bool $debug=false)
    {
        var_dump(1);
        $this->userName = $userName;
        $this->password = $password;
        $this->httpGateway = $httpGateway;
        $this->debug = $debug;
        $this->client = new \GuzzleHttp\Client([
            'base_uri'        => $httpGateway,
            'timeout'         => 0,
            'debug'           => $this->debug,
            'verify'          => false,
        ]);
    }


    
    /**
     * 发送原始文本短信
     *
     * @param string $mobile
     * @param string $content
     * @return array [bool:success, array:responseArr]
     * @throws \GuzzleHttp\Exception\*
     */
    public function send(string $mobile, string $content):array 
    {
        $timestamp = time() * 1000; // ms
        $sign = md5($this->userName . $timestamp . md5($this->password));
        $data = [
            'userName'      => $this->userName,
            'timestamp'     => $timestamp,
            'password'      => $this->password,
            'messageList'   => array(array('phone' => $mobile, 'content' => $content)),
            'sign'          => $sign,
        ];

        $response = $this->client->post('api/sendMessageOne', ['json' => $data]);

        $responseArr = json_decode($response->getBody()->getContents(), true);
        $success = false;
        if (isset($responseArr['code']) && $responseArr['code'] == 0) {
            $success = true;
        }
        
        return [$success, $responseArr];
    }


    /**
     * 查询短信发送详情
     *
     * @param string $taskid
     * @return array [bool:success, array:responseArr]
     * @deprecated 
     * @throws \GuzzleHttp\Exception\*
     */
    public function detail(string $taskid, string $mobile):array {        
        throw new \RuntimeException('该功能未实现');
    }





    /**
     * 查询短信签名列表
     *
     * @param string $signId 可空，指定短信签名id，留空查询所有
     * @return array [bool:success, array:responseArr]
     * @deprecated 
     * @throws \GuzzleHttp\Exception\*
     */
    public function getSignList(string $sign_id=''):array {
        throw new \RuntimeException('该功能未实现');
    }






    /**
     * 查询短信模板列表
     *
     * @param string $template_id 可空，指定查询短信模板，留空查询所有
     * @return array [bool:success, array:responseArr]
     * @deprecated 
     * @throws \GuzzleHttp\Exception\*
     */
    public function getTemplateList(string $template_id=''):array {
        throw new \RuntimeException('该功能未实现');
    }
}