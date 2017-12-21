<?php

namespace App\Crypt;

use RuntimeException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Contracts\Encryption\Encrypter;

/**
 * Encrypt data
 */

class AESCipher
{
	private static $OPENSSL_CIPHER_NAME = "AES-128-CBC"; //Name of OpenSSL Cipher 
    private static $CIPHER_KEY_LEN = 16; //128 bits


    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     * 
     * @param type $key - key to use should be 16 bytes long (128 bits)
     * @param type $iv - initialization vector
     * @param type $data - data to encrypt
     * @return encrypted data in base64 encoding with iv attached at end after a :
     */

    static function encrypt($key, $data) {

    	$iv = random_bytes(16);
    	if (strlen($key) < AESCipher::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", AESCipher::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > AESCipher::$CIPHER_KEY_LEN) {
            $key = substr($key, 0, AESCipher::$CIPHER_KEY_LEN); //truncate to 16 bytes
            // $key = str_limit($key, 16, '');
        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, AESCipher::$OPENSSL_CIPHER_NAME, $key,OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;

        return $encryptedPayload;

    }


    /**
     * Decrypt data using AES Cipher (CBC) with 128 bit key
     * 
     * @param type $key - key to use should be 16 bytes long (128 bits)
     * @param type $data - data to be decrypted in base64 encoding with iv attached at the end after a :
     * @return decrypted data
     */
    static function decrypt($key, $data) {
    	if (strlen($key) < AESCipher::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", AESCipher::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > AESCipher::$CIPHER_KEY_LEN) {
            $key = substr($key, 0, AESCipher::$CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $parts = explode(':', $data); //Separate Encrypted data from iv.
        $decryptedData = openssl_decrypt(base64_decode($parts[0]), AESCipher::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));

        return $decryptedData;
    }


    /**
     * Create key using AES Cipher (CBC) with 128 bit key
     * 
     * @param type $data - data to encrypt
     * @param type $key - get the first 16 bytes from data
     * @param type $iv - initialization vector
     * @return the first 16 bytes after encrypted data in base64 encoding with iv attached
     */
    static function create_key($data)
    {
    	$iv = "1234567890ABCDEF";
    	$key='';
    	if (strlen($data) < AESCipher::$CIPHER_KEY_LEN) {
            $key = str_pad("$data", AESCipher::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($data) > AESCipher::$CIPHER_KEY_LEN) {
            $key = substr($data, 0, AESCipher::$CIPHER_KEY_LEN); //truncate to 16 bytes
            // $key = str_limit($key, 16, '');
        }

        $aes_key = base64_encode(openssl_encrypt($data, AESCipher::$OPENSSL_CIPHER_NAME, $key,OPENSSL_RAW_DATA, $iv));
        $aes_key = substr($aes_key, 0, AESCipher::$CIPHER_KEY_LEN);
        return $aes_key;
    }
}