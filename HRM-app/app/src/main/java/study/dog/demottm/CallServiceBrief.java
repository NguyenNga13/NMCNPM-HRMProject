package study.dog.demottm;

import android.content.Context;
import android.nfc.Tag;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by Nguyen Nga on 23/04/2017.
 */

public class CallServiceBrief extends AsyncTask<String, Integer, String> {
    String memCode;
    String memName, depart, imCardURL;

    private static final String TAG = "MESSENGER";

    public CallServiceBrief(String memCode) {
        this.memCode = memCode;
    }

    @Override
    protected String doInBackground(String... params) {
        return requestData(params[0], memCode);
    }

    @Override
    protected void onPostExecute(String s) {
//        Toast.makeText(context, "m", Toast.LENGTH_LONG).show();
//        System.out.print(s);
        Log.d(TAG, s);
        try {
            JSONArray jsonArray = new JSONArray(s);
            JSONObject jsonObject = jsonArray.getJSONObject(0);
            memName = jsonObject.getString("memCode");
            imCardURL = jsonObject.getString("passLogin");
            depart = jsonObject.getString("status");
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }

    public String getMemName() {
        return memName;
    }

    public String getDepart() {
        return depart;
    }

    public String getImCardURL() {
        return imCardURL;
    }

    private String requestData(String u, String m) {
        HttpClient httpClient = new DefaultHttpClient();

        // URL của trang web nhận request
        HttpPost httpPost = new HttpPost(u);

        // Các tham số truyền
        List nameValuePair = new ArrayList();
        nameValuePair.add(new BasicNameValuePair("memCode", m));

        //Encoding POST data
        try {
            httpPost.setEntity(new UrlEncodedFormEntity(nameValuePair));
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        }

        String result = "";
        try {
            HttpResponse response = httpClient.execute(httpPost);
            HttpEntity entity = response.getEntity();
            result = EntityUtils.toString(entity);
        } catch (ClientProtocolException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }

        return result;
    }
}
