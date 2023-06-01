<?php
namespace jumdata\test;

// require_once '../src/Sms.php';
use jumdata\Sms;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv();
$env->load(dirname(__DIR__) . '/.env');

class SmsTest extends TestCase  {



    /**
     * 测试发送短信
     * @test
     * @return void
     */
    public function testSend() {
        $sms = new Sms($_ENV['USERNAME'], $_ENV['PASSWORD']);
        list($success, $response) = $sms->send('18311548014', 'ce试试');
        $this->assertTrue($success);
        $this->assertIsArray($response);
    }

}