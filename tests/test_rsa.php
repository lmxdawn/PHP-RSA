<?php

header("Content-type:text/html; charset=utf-8");


require "../src/RsaCrypt.php";

$options = [
    'private_key' => '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQC6l1VcRSMuF6DTV0gdCr0oeRgzURCnrwu9zB91lMZ44oaQtBQk
wmBoaIibzM0on5B8mXxXlEzhyOoj2Ylaskh3quuYl2lU5VvkqBLJYZSFlJs9ByZQ
G5+YhMkwRwzaCw67FJsD/bJTpARLAXJVBKdCj4Fro2y+w/5w6esf7h09CQIDAQAB
AoGBAJ/ZJXd2gzzpYQ2sqEq4+HPDycesmugMPbLLO+gvHBhTd5RfsSIMoyrO4rkW
KmuyxsT3eF5O3c5PoMY1hkX8lbb4XSCkXDm/Zwfv9b+3J7gv0Hrl+q2hYmtIqdMB
vnLS5PtM3SB6kzuCZJk1NuedewEL7/4Rpxyaw0Jjo+ixBkJBAkEA3ppWbYd6TEEo
wCwgITvNeTdvm/0GVEKNqgOcqdnVNKz8/lzMLMyaHG8Dq8fMPzKRhCY4EBCTi+P2
mczWCcyT/wJBANaV3kf0P0vXXOLgridJ/DZ9XGGm0+apOQ7D/ci/N9O4RpPoEerH
kQOImsAuKPYINr1cwsd/2hWYoWKxdMRdjvcCQDDd6slCq3tf9oUxaqBBE5tfqxWw
VxpaPeUrw9GZq29T5nokfwH6rH4/dKvaQaFCBaXgCgCk0u8rzS/4QqiGC5sCQGqD
BUxN7kUk5xQuVgNmc+xQGVTXTAMIKCwuGIBWec17gHzWCl6xJEfOvJF72BUXSqR/
sKb5zTQ/CIxGbSEzF00CQQCcphnvT/zc7kMSCl5LhDA4Hf8TSoV5zrry8nemEhi8
P6IPDOuyfn699kprL2UjknpdRFJ1/gDRTLALP6KJrmfy
-----END RSA PRIVATE KEY-----',
    'public_key' => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6l1VcRSMuF6DTV0gdCr0oeRgz
URCnrwu9zB91lMZ44oaQtBQkwmBoaIibzM0on5B8mXxXlEzhyOoj2Ylaskh3quuY
l2lU5VvkqBLJYZSFlJs9ByZQG5+YhMkwRwzaCw67FJsD/bJTpARLAXJVBKdCj4Fr
o2y+w/5w6esf7h09CQIDAQAB
-----END PUBLIC KEY-----',
];

$options = json_decode(json_encode($options),true);

$rsa = \lmxdawn\rsa\RsaCrypt::getInstance($options);//实例化单例类


if ($_POST){
    //web端公钥加密的内容
    $pu_pwd = $_POST["pu_pwd"];
    $decrypted = $rsa->decodePublicEncode($pu_pwd);
    if ($decrypted){
        echo '私钥解密公钥加密的内容：'.$decrypted;
    }else{
        echo "私钥解密失败";
    }
    exit;
}

$str = md5('123456');
echo '原始数据：'.$str . '<br><br><br>';

//私钥加密
$data = $rsa->privateKeyEncode($str);
if (!empty($data)){
    echo '私钥加密：'.$data . '<br><br><br>';
}else{
    echo '私钥加密失败 <br><br><br>';
}


//公钥解密
$decode = $rsa->decodePrivateEncode($data);
if (!empty($decode)){
    echo '公钥解密：'.$decode . '<br><br><br>';
}else{
    echo '公钥解密失败 <br><br><br>';
}

//公钥加密
$str = md5('654789');
echo '原始数据：'.$str . '<br><br><br>';

$pdata = $rsa->publicKeyEncode($str);
if ($pdata){
    echo '公钥加密：'.$pdata . '<br><br><br>';
}else{
    echo '公钥加密失败';
}

//私钥解密
$pdecode = $rsa->decodePublicEncode($pdata);
if ($pdecode){
    echo '私钥解密：'.$pdecode . '<br><br><br>';
}else{
    echo '私钥解密失败 <br><br><br>';
}


//私钥解密




?>
