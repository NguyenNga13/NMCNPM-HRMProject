package study.dog.demottm.crypt;

import android.util.Base64;

import java.util.Random;

import javax.crypto.Cipher;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;

/**
 * Created by Nguyen Nga on 28/09/2017.
 */

public class AESCipher {
    private static String CIPHER_NAME = "AES/CBC/PKCS5PADDING";
    private static int CIPHER_KEY_LEN = 16; //128 bits

    /**
     * Encrypt data using AES Cipher (CBC) with 128 bit key
     *
     * @param key  - key to use should be 16 bytes long (128 bits)
     * @param data - data to encrypt
     * @return encryptedData data in base64 encoding with iv attached at end after a :
     */
    public static String encrypt(String key, String data) {
        String iv = AESCipher.randomIV();
        try {
            if (key.length() < AESCipher.CIPHER_KEY_LEN) {
                int numPad = AESCipher.CIPHER_KEY_LEN - key.length();

                for (int i = 0; i < numPad; i++) {
                    key += "0"; //0 pad to len 16 bytes
                }

            } else if (key.length() > AESCipher.CIPHER_KEY_LEN) {
                key = key.substring(0, CIPHER_KEY_LEN); //truncate to 16 bytes
            }


            IvParameterSpec initVector = new IvParameterSpec(iv.getBytes("UTF-8"));
            SecretKeySpec skeySpec = new SecretKeySpec(key.getBytes("UTF-8"), "AES");

            Cipher cipher = Cipher.getInstance(AESCipher.CIPHER_NAME);
            cipher.init(Cipher.ENCRYPT_MODE, skeySpec, initVector);

            byte[] encryptedData = cipher.doFinal((data.getBytes()));

            String base64_EncryptedData = new String(Base64.encodeToString(encryptedData, Base64.DEFAULT));
            String base64_IV = new String(Base64.encodeToString(iv.getBytes("UTF-8"), Base64.DEFAULT));

//            String en = base64_EncryptedData + ':' + base64_IV;
//            en.replaceAll("\\n", "");
            return base64_EncryptedData.replaceAll("\n", "") + ':' + base64_IV.replaceAll("\n", "");

        } catch (Exception ex) {
            ex.printStackTrace();
        }

        return null;
    }


    /**
     * Decrypt data using AES Cipher (CBC) with 128 bit key
     *
     * @param key  - key to use should be 16 bytes long (128 bits)
     * @param data - encrypted data with iv at the end separate by :
     * @return decrypted data string
     */

    public static String decrypt(String key, String data) {
        try {

            if (key.length() < AESCipher.CIPHER_KEY_LEN) {
                int numPad = AESCipher.CIPHER_KEY_LEN - key.length();

                for (int i = 0; i < numPad; i++) {
                    key += "0"; //0 pad to len 16 bytes
                }

            } else if (key.length() > AESCipher.CIPHER_KEY_LEN) {
                key = key.substring(0, CIPHER_KEY_LEN); //truncate to 16 bytes
            }

            String[] parts = data.split(":");

            IvParameterSpec iv = new IvParameterSpec(Base64.decode(parts[1], Base64.DEFAULT));
            SecretKeySpec skeySpec = new SecretKeySpec(key.getBytes("UTF-8"), "AES");

            Cipher cipher = Cipher.getInstance(AESCipher.CIPHER_NAME);
            cipher.init(Cipher.DECRYPT_MODE, skeySpec, iv);

            byte[] decodedEncryptedData = Base64.decode(parts[0], Base64.DEFAULT);

            byte[] original = cipher.doFinal(decodedEncryptedData);

            return new String(original);
        } catch (Exception ex) {
            ex.printStackTrace();
        }

        return null;
    }


    /**
     * Create iv by random char from alphaber array
     * @return iv
     */
    public static String randomIV() {
        String alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#%&()*+,-.;<=>?@[]^_`{|}~";
        String iv = "";
        Random random = new Random();
        for (int i = 0; i < 16; i++) {
            iv += alphabet.charAt(random.nextInt(alphabet.length()));
        }
        return iv;
    }

    /**
     * Create AES key by encrypt password using AES Cipher (CBC) with 128 bit key
     *
     * @param pass  - password to encrypted
     * @return encryptedData data in base64 encoding with iv attached create by get the first 16 bytes of password
     */
    public static String createKey(String pass) {
        String key = pass;
        if (pass.length() < AESCipher.CIPHER_KEY_LEN) {
            int numPad = AESCipher.CIPHER_KEY_LEN - pass.length();

            for (int i = 0; i < numPad; i++) {
                key += "0"; //0 pad to len 16 bytes
            }

        } else if (pass.length() > AESCipher.CIPHER_KEY_LEN) {
            key = key.substring(0, CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        String iv = "1234567890ABCDEF";
        try {

            IvParameterSpec initVector = new IvParameterSpec(iv.getBytes("UTF-8"));
            SecretKeySpec skeySpec = new SecretKeySpec(key.getBytes("UTF-8"), "AES");

            Cipher cipher = Cipher.getInstance(AESCipher.CIPHER_NAME);
            cipher.init(Cipher.ENCRYPT_MODE, skeySpec, initVector);

            byte[] encryptedData = cipher.doFinal((pass.getBytes()));

            String base64_EncryptedData = Base64.encodeToString(encryptedData, Base64.DEFAULT);
            base64_EncryptedData = base64_EncryptedData.substring(0, CIPHER_KEY_LEN);
            return base64_EncryptedData;


        } catch (Exception ex) {
            ex.printStackTrace();
        }

        return null;
    }
}
