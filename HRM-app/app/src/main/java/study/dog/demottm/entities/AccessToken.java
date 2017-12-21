package study.dog.demottm.entities;

/**
 * Created by Nguyen Nga on 08/09/2017.
 */

public class AccessToken {
    String tokenType; //token_type
    int expiresIn;  //expires_in
    String accessToken; //access_token
    String refreshToken; //refresh_token

//    public AccessToken(String tokenType, int expiresIn, String accessToken, String refreshToken) {
//        this.tokenType = tokenType;
//        this.expiresIn = expiresIn;
//        this.accessToken = accessToken;
//        this.refreshToken = refreshToken;
//    }

    public String getTokenType() {
        return tokenType;
    }

    public void setTokenType(String tokenType) {
        this.tokenType = tokenType;
    }

    public int getExpiresIn() {
        return expiresIn;
    }

    public void setExpiresIn(int expiresIn) {
        this.expiresIn = expiresIn;
    }

    public String getAccessToken() {
        return accessToken;
    }

    public void setAccessToken(String accessToken) {
        this.accessToken = accessToken;
    }

    public String getRefreshToken() {
        return refreshToken;
    }

    public void setRefreshToken(String refreshToken) {
        this.refreshToken = refreshToken;
    }
}
