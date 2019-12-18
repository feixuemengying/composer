<?php

namespace ShengQianFu\Secret;
/**
 * openssl secret
 *
 * @author 马腾飞 <mtf@shengqianfu.com>
 */
class Secret
{
    public static $instace;
    private $pri_key;
    private $pub_key;
    private function __construct()
    {
    }

    public static function getInstace()
    {
        if (self::$instace instanceof self)
            return self::$instace;
        return self::$instace = new self();
    }
    /**
     * 生成密钥文件
     * 
     * @param string $id 密钥文件名
     * @param string $cnf openssl.cnf文件路径
     */
    function rsa($id,$cnf = '')
    {
        
        $config = array(
            "digest_alg" => "shengqianfu",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
            'config' =>is_file($cnf.DIRECTORY_SEPARATOR . "openssl.cnf")?$cnf.DIRECTORY_SEPARATOR . "openssl.cnf":__DIR__ . DIRECTORY_SEPARATOR . "openssl.cnf"
        );

        //创建密钥对
        $res = openssl_pkey_new($config);
        //生成私钥
        openssl_pkey_export($res, $priKey, null, $config);
        //生成公钥
        $pubKey = openssl_pkey_get_details($res);
        //服务器私钥文件名
        $this->pri_key = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $id."_rsa_key.pem";
        $this->pub_key = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $id."_rsa_key_pub.pem";
        //写入服务器私钥
        file_put_contents($this->pri_key, $priKey);
        file_put_contents($this->pub_key, $pubKey['key']);
    }
    /**
     * 加密数据
     * 
     * @param string $data 要加密的数据
     * @return string base64_encode
     */
    function crypt($data)
    {
        openssl_public_encrypt($data, $crypttext, openssl_pkey_get_public(file_get_contents($this->pub_key)));
        return base64_encode($crypttext);
    }
    /**
     * 解密数据
     * 
     * @param string $data 要解密的base64_encode数据
     * @return string 解密后的数据
     */
    function decrypt($data)
    {
        openssl_private_decrypt(base64_decode($data), $decrypttext, openssl_pkey_get_private(file_get_contents($this->pri_key)));
        return $decrypttext;
    }
}
