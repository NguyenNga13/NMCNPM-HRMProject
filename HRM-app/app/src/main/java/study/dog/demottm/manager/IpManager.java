package study.dog.demottm.manager;

import android.content.SharedPreferences;

/**
 * Created by Nguyen Nga on 20/09/2017.
 */

public class IpManager {
    private SharedPreferences prefs;
    private SharedPreferences.Editor editor;
    private static IpManager INSTANCE = null;

    public IpManager(SharedPreferences prefs){
        this.prefs = prefs;
        this.editor = prefs.edit();
    }

    public static synchronized IpManager getInstance(SharedPreferences prefs){
        if(INSTANCE == null){
            INSTANCE = new IpManager(prefs);
        }
        return INSTANCE;
    }

    public void saveIp(String ip){
        editor.putString("IP_ADDRESS", ip).commit();
    }

    public String getIp()
    {
        String ip = prefs.getString("IP_ADDRESS", null);
        return  ip;
    }

    public void deleteIp(){
        editor.remove("IP_ADDRESS").commit();
    }

    public String getUrl( String url) {
        String ip  = prefs.getString("IP_ADDRESS", null);
        return "http://" + ip + ":8080/laravel/HRMProject/public/api/" + url;
    }

    public String getUrlPhotocard(String url_photo){
        String ip =  prefs.getString("IP_ADDRESS", null);
        return "http://"+ip+ ":8080/laravel/HRMProject/public/image/employee/cardimage/"+url_photo;
    }
}

