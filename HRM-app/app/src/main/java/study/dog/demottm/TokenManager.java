package study.dog.demottm;

import android.content.SharedPreferences;

import study.dog.demottm.entities.AccessToken;

/**
 * Created by Nguyen Nga on 08/09/2017.
 */

public class TokenManager {

    private SharedPreferences prefsToken;
    private SharedPreferences.Editor editor;

    private static TokenManager INSTANCE = null;

    private TokenManager(SharedPreferences prefsToken){
        this.prefsToken = prefsToken;
        this.editor = prefsToken.edit();
    }

    static synchronized TokenManager getInstance(SharedPreferences prefsToken){
        if(INSTANCE == null){
            INSTANCE = new TokenManager(prefsToken);
        }
        return INSTANCE;
    }

    public void saveToken(AccessToken token){
        editor.putString("TOKEN_TYPE", token.getTokenType()).commit();
        editor.putInt("EXPIRES_IN", token.getExpiresIn()).commit();
        editor.putString("ACCESS_TOKEN", token.getAccessToken()).commit();
        editor.putString("REFRESH_TOKEN", token.getRefreshToken()).commit();
    }

    public AccessToken getToken(){
        AccessToken token = new AccessToken();
        token.setTokenType(prefsToken.getString("TOKEN_TYPE", null));
        token.setExpiresIn(prefsToken.getInt("EXPIRES_IN", 0));
        token.setAccessToken(prefsToken.getString("ACCESS_TOKEN", null));
        token.setRefreshToken(prefsToken.getString("REFRESH_TOKEN", null));
        return token;
    }

    public void deleteToken(){
        editor.remove("TOKEN_TYPE").commit();
        editor.remove("EXPIRES_IN").commit();
        editor.remove("ACCESS_TOKEN").commit();
        editor.remove("REFRESH_TOKEN").commit();
    }
}
