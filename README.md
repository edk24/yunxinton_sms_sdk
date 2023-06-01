
# 云信通SDK

[官网](http://106.yntykjjt.com/sms/login.html)

安装

```bash
composer require yuxiaobo/yunxinton_sms_sdk
```

## 单元测试

```bash
./vendor/bin/phpunit test/SmsTest.php
```

## 短信SDK

> 已完成

- send 发送短信
- ~~detail 查询短信发送详情~~
- ~~getSignList 查询短信签名列表~~
- ~~getTemplateList 查询短信模板列表~~

#### 发送短信

```php
$sms = new Sms($_ENV['USERNAME'], $_ENV['PASSWORD']);
list($success, $response) = $sms->send('18311548014', 'ce试试');

if ($success == false) {
    // 短信发送失败
}
```

## 更新记录

> 1.0.0

- 🎉 开发上架完成
