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
    private $pri_key; //私钥文件
    private $pub_key; //公钥文件
    private $config = array(
        "private_key_bits" => 1024,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    ); //openssl配置

    private function __construct($prefix,$cnf = '')
    {
        if(!file_exists($cnf . DIRECTORY_SEPARATOR . "openssl.cnf") && !file_exists(__DIR__ . DIRECTORY_SEPARATOR . "openssl.cnf"))
        {
            throw new \Exception("openssl.cnf require", 1);
        }
        $this->config['config'] = file_exists($cnf . DIRECTORY_SEPARATOR . "openssl.cnf") ? $cnf . DIRECTORY_SEPARATOR . "openssl.cnf" : __DIR__ . DIRECTORY_SEPARATOR . "openssl.cnf";
        if(!is_dir(__DIR__ . DIRECTORY_SEPARATOR .'rsa')){
            mkdir(__DIR__ . DIRECTORY_SEPARATOR .'rsa',0777,true);
        }
        $this->pri_key = __DIR__ . DIRECTORY_SEPARATOR .'rsa'. DIRECTORY_SEPARATOR . $prefix . "_rsa_key.pem";  
        $this->pub_key = __DIR__ . DIRECTORY_SEPARATOR .'rsa'. DIRECTORY_SEPARATOR . $prefix . "_rsa_key_pub.pem";
    }
    /**
     * 获取单例
     * 
     * @param string $prefix 密钥文件前缀
     * @param string $cnf openssl.cnf文件路径,默认__DIR__
     */
    public static function getInstace($prefix,$cnf = '')
    {
        if (self::$instace instanceof self)
            return self::$instace;
        return self::$instace = new self($prefix,$cnf = '');
    }
    /**
     * 生成密钥文件
     * 
     * @param string $id 密钥文件名
     * @param string $cnf openssl.cnf文件路径
     */
    function rsa()
    {
        if (file_exists($this->pri_key)||file_exists($this->pub_key)) {
            throw new \Exception(".pem exits");
        } else {
            //创建密钥对
            $res = openssl_pkey_new($this->config);
            //获取私钥
            openssl_pkey_export($res, $priKey, null, $this->config);
            //生成公钥
            $pubKey = openssl_pkey_get_details($res);

            //写入服务器
            file_put_contents($this->pri_key, $priKey);
            file_put_contents($this->pub_key, $pubKey['key']);
        }
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
     * @param string $base64_encode_data 要解密的base64_encode数据
     * @return string 解密后的数据
     */
    function decrypt($base64_encode_data)
    {
        openssl_private_decrypt(base64_decode($base64_encode_data), $decrypttext, openssl_pkey_get_private(file_get_contents($this->pri_key)));
        return $decrypttext;
    }
}
