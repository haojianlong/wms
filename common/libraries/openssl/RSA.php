<?php
/**
 * Created by PhpStorm.
 * User: hjl
 * Date: 2018/1/3
 * Time: 下午4:39
 */

namespace common\libraries\openssl;

class RSA
{
    public static $privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBALmTI9oYWzGEWFIp
u3O4ACpu8bvY2z/3i/bTLtko+c5neJ9f+niuYs9E5leBMThIe2kXuZRvzcKy9g/I
RvG4AtlNcCc81jfBc/DOChxqP9BR7HgVY+5xrkLKvROAUhDAwylg/35BHFHvmG+f
E1n1FUOBX9MdA7T3Tdow0je1WRFLAgMBAAECgYAIRWeeq+E8psJs/xEsyjGvsnwx
vCuhgT4KxUTcRvhDW9dDezqlsFgVFuQRWF/CO3DMsVMDK6yHFgTjlTCcS3BM/bYC
nwkr1tNRrPIDtoxarX+NIsrCe/Sg/9SilMcMupS3ysOXQ/23bOLuGy5T6tmr7eCh
CWi9hJOPOGzc9NrIEQJBAOJ0KI5JLugyy8OpD0ZKfP8QLHpWCGC1TOwlh1IQSsp/
u46bmbOWlypuHox5jtZhICnV0Qb8cVe6GIkuuM04L7MCQQDRyZJw3qO2AkMUC/tM
yxAHNMHkJ/3Xjr5DwxG1sejgI36xwQ2ElaTOmXJHaQ5prEUJI5AmLISgGKNrgmvp
0QwJAkEArrk9SXuB67q1qYPZuzxh8VMDXmjfEe8RKOtT26eibVfc2Q2JrB03CY/p
li18XkCWVnEZVLCWqz91CvO3tu/xLQJBANFo3+gRJeQKMAEz0J8gWBiJXj4seWQR
1fT4JJZ1SBts8wvmxGKjqcadP4ju4nczghoUSNECQUU6Mu6fWq8kgFkCQQC1+oJQ
+RpUHrMNE8p4OAvPxMzrWPn9F/CBCy0yO5bXn+mkbgLlZSv5jwgjAs/yTmlwLKs5
6IeDO1xkHTmoYia9
-----END PRIVATE KEY-----
EOD;

    public static $publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC5kyPaGFsxhFhSKbtzuAAqbvG7
2Ns/94v20y7ZKPnOZ3ifX/p4rmLPROZXgTE4SHtpF7mUb83CsvYPyEbxuALZTXAn
PNY3wXPwzgocaj/QUex4FWPuca5Cyr0TgFIQwMMpYP9+QRxR75hvnxNZ9RVDgV/T
HQO0903aMNI3tVkRSwIDAQAB
-----END PUBLIC KEY-----
EOD;

    public static function generate()
    {
        $res = openssl_pkey_new([
            "digest_alg" => "SHA256",
            "private_key_bits" => 1024,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ]);
        openssl_pkey_export($res, $private_key);
        $public_key = openssl_pkey_get_details($res);
        return [
            'public_key' => $public_key["key"],
            'private_key' => $private_key
        ];
    }
}