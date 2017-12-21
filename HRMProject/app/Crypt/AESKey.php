<?php

namespace App\Crypt;

use App\Crypt\AESCipher;

class AESKey
{
	private static $KEY_LENGHT = 16; //128 bits
	private static $OPENSSL_CIPHER_NAME = "AES-128-CBC"; //Name of OpenSSL Cipher 

	static function create_key($string)
	{
		$iv = "1234567890ABCDEF";
		$key='';
		if (strlen($string) < AESKey::$KEY_LENGHT) {
            $key = str_pad("$string", AESKey::$KEY_LENGHT, "0"); //0 pad to len 16
        } else if (strlen($string) > AESKey::$KEY_LENGHT) {
            $key = substr($string, 0, AESKey::$KEY_LENGHT); //truncate to 16 bytes
            // $key = str_limit($key, 16, '');
        }

        $aes_key = base64_encode(openssl_encrypt($string, AESKey::$OPENSSL_CIPHER_NAME, $key,OPENSSL_RAW_DATA, $iv ));
        $aes_key = substr($aes_key, 0, AESKey::$KEY_LENGHT);
        return $aes_key;
	}

}