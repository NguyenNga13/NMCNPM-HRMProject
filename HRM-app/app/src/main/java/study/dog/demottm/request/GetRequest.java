package study.dog.demottm.request;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;

import javax.net.ssl.HttpsURLConnection;

/**
 * Created by Nguyen Nga on 22/09/2017.
 */

public class GetRequest {
    private String url, token;

    public GetRequest(String url, String token) {
        this.url = url;
        this.token = token;
    }

    public String get(){
        try {
            URL profileUrl = new URL(url);

            HttpURLConnection connect = (HttpURLConnection)profileUrl.openConnection();
            connect.setRequestMethod("GET");
            String auth = "Bearer " + token;
            connect.setRequestProperty("Authorization", auth);

            int responseCode = connect.getResponseCode();
            System.out.println("GET response code :: " + responseCode);

            if(responseCode == HttpsURLConnection.HTTP_OK){
                BufferedReader in = new BufferedReader(new InputStreamReader(connect.getInputStream()));
                String inputLine;
                StringBuffer response = new StringBuffer();
                while ((inputLine = in.readLine()) != null){
                    response.append(inputLine);
                }
                in.close();
                System.out.println(response.toString());
                return response.toString();
            }else {
                System.out.print("GET request not worked");
                return new String("GET request not worked - code: " + responseCode);
            }

        } catch (Exception e) {
            System.out.print("Exception: " + e.getMessage());
            return new String("Exception: " + e.getMessage());
        }
    }

//    public String getUrl() {
//        return url;
//    }
//
//    public void setUrl(String url) {
//        this.url = url;
//    }
//
//    public String getToken() {
//        return token;
//    }
//
//    public void setToken(String token) {
//        this.token = token;
//    }
}
