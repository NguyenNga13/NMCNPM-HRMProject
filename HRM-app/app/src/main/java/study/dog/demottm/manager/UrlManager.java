package study.dog.demottm.manager;

import static android.content.Context.MODE_PRIVATE;
import android.content.SharedPreferences;

/**
 * Created by Nguyen Nga on 08/09/2017.
 */

public class UrlManager {
    String ip;
//    String url;

//

    public void setIp(String ip) {
        this.ip = ip;
    }

//    public void setUrl(String url) {
//        this.url = url;
//    }

//    http://192.168.0.102:8080/laravel/HRMProject/public/api/logout
//    http://192.168.0.102:8080/hrm/image/personel/cardimage/N0001.jpg
    public String getUrl( String url) {
        return "http://" + ip + ":8080/laravel/HRMProject/public/api/" + url;
    }

    public String getUrlPhotocard(String url_photo){
        return "http://"+ip+ ":8080/laravel/HRMProject/public/image/employee/cardimage/"+url_photo;
    }
}
