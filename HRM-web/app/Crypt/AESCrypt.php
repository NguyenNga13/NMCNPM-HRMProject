<?php

namespace App\Crypt;

use RuntimeException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Contracts\Encryption\Encrypter;

class AESCrypt implements Encrypter
{
	protected $key;
	protected $cipher;


	public function __construct()
	{
		$this->key = "v=StFvAYmg04o&list=PLEubh3Rmu4tn8xtkVcWnWOjQ";
		$this->cipher = "AES-256-CBC";
	}

	// public function __construct($key, $cipher = 'AES-128-CBC')
 //    {
 //        $key = (string) $key;

 //        if (static::supported($key, $cipher)) {
 //            $this->key = $key;
 //            $this->cipher = $cipher;
 //        } else {
 //            throw new RuntimeException('The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths.');
 //        }
 //    }



	public function encrypt($value, $serialize = true)
	{
		$iv = "0123456789ABCDEF";
        // $iv = "0123456789ABCDEF";

        // First we will encrypt the value using OpenSSL. After this is encrypted we
        // will proceed to calculating a MAC for the encrypted value so that this
        // value can be verified later as not having been changed by the users.
		$value = openssl_encrypt($value, $this->cipher, $this->key, 0, $iv);

		if ($value === false) {
			throw new EncryptException('Could not encrypt the data.');
		}

        // Once we get the encrypted value we'll go ahead and base64_encode the input
        // vector and create the MAC for the encrypted value so we can then verify
        // its authenticity. Then, we'll JSON the data into the "payload" array.
	

		// $mac = $this->hash($iv = base64_encode($iv), $value);


		$json = json_encode(compact('iv', 'value', 'mac'));

		if (! is_string($json)) {
			throw new EncryptException('Could not encrypt the data.');
		}

		return base64_encode($value);

		// return base64_encode($json);
        // return base64_encode($mac);
	}

	public function encryptString($value)
	{
		return $this->encrypt($value, false);
	}



	public function decrypt($payload, $unserialize = true)
	{
		$payload = $this->getJsonPayload($payload);

		$iv = base64_decode($payload['iv']);

        // Here we will decrypt the value. If we are able to successfully decrypt it
        // we will then unserialize it and return it out to the caller. If we are
        // unable to decrypt this value we will throw out an exception message.
		$decrypted = \openssl_decrypt(
			$payload['value'], $this->cipher, $this->key, 0, $iv
		);

		if ($decrypted === false) {
			throw new DecryptException('Could not decrypt the data.');
		}

		return $unserialize ? unserialize($decrypted) : $decrypted;
	}


	public function decryptString($payload)
	{
		return $this->decrypt($payload, false);
	}


	protected function hash($iv, $value)
	{
		return hash_hmac('sha256', $iv, $this->key);
	}



	protected function getJsonPayload($payload)
	{
		$payload = json_decode(base64_decode($payload), true);

        // If the payload is not valid JSON or does not have the proper keys set we will
        // assume it is invalid and bail out of the routine since we will not be able
        // to decrypt the given value. We'll also check the MAC for this encryption.
		if (! $this->validPayload($payload)) {
			throw new DecryptException('The payload is invalid.');
		}

		if (! $this->validMac($payload)) {
			throw new DecryptException('The MAC is invalid.');
		}

		return $payload;
	}


	protected function validPayload($payload)
	{
		return is_array($payload) && isset(
			$payload['iv'], $payload['value'], $payload['mac']
		);
	}

    /**
     * Determine if the MAC for the given payload is valid.
     *
     * @param  array  $payload
     * @return bool
     */
    protected function validMac(array $payload)
    {
    	$calculated = $this->calculateMac($payload, $bytes = random_bytes(16));

    	return hash_equals(
    		hash_hmac('sha256', $payload['mac'], $bytes, true), $calculated
    	);
    }

    /**
     * Calculate the hash of the given payload.
     *
     * @param  array  $payload
     * @param  string  $bytes
     * @return string
     */
    protected function calculateMac($payload, $bytes)
    {
    	return hash_hmac(
    		'sha256', $this->hash($payload['iv'], $payload['value']), $bytes, true
    	);
    }

    /**
     * Get the encryption key.
     *
     * @return string
     */
    public function getKey()
    {
    	return $this->key;
    }



}