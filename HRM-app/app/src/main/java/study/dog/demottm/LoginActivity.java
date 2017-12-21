package study.dog.demottm;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.TextView;
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

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

import javax.net.ssl.HttpsURLConnection;

import study.dog.demottm.crypt.AESCipher;
import study.dog.demottm.entities.AccessToken;
import study.dog.demottm.manager.DateManager;
import study.dog.demottm.manager.IpManager;
import study.dog.demottm.request.GetRequest;

public class LoginActivity extends AppCompatActivity {
    Button btLogin;
    EditText editUsername, editPassword;

    CheckBox cBoxRemember;
    TextView tvForgotPassword;

    String memCode, password;
    String aesKey;
    String ip;

    Integer counter = 3;
    SharedPreferences loginPreferences;
    SharedPreferences.Editor editorLoginPreferences;
    Boolean rememberChecked;

    SharedPreferences prefsAESKey;
    SharedPreferences.Editor editorAESKey;


    IpManager ipManager;
    TokenManager tokenManager;
    AccessToken accessToken;

    DateManager dateManager;


    private static final String TAG = "LoginActivity";

    @Override
    protected void onCreate(final Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        if (ipManager.getIp() == null) {
            ipManager.saveIp("192.168.0.102");
        }

        editUsername = (EditText) findViewById(R.id.edit_username);
        editPassword = (EditText) findViewById(R.id.edit_password);

        cBoxRemember = (CheckBox) findViewById(R.id.cbox_remember);
        tvForgotPassword = (TextView) findViewById(R.id.tv_forgot_password);
        btLogin = (Button) findViewById(R.id.bt_login);

        prefsAESKey = getSharedPreferences("prefsAESKey", MODE_PRIVATE);
        editorAESKey = prefsAESKey.edit();

        loginPreferences = getSharedPreferences("loginPreferences", MODE_PRIVATE);
        editorLoginPreferences = loginPreferences.edit();

        //Get username and pass were remembered
        rememberChecked = loginPreferences.getBoolean("statusRemember", false);

        dateManager = new DateManager();

        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        if (bundle != null) {
            Log.d(TAG, "logout");
            new sendGetLogoutRequest().execute();

        } else {
            // auto login if access token  unexpired
            if ( rememberChecked == true && tokenManager.getToken().getAccessToken() != null && tokenManager.getToken().getExpiresIn() > dateManager.getCurrentDay()) {
                Intent intentMain = new Intent(LoginActivity.this, MainActivity.class);
                startActivity(intentMain);
                finish();
            }
        }

        if (rememberChecked == true) {
            editUsername.setText(loginPreferences.getString("username", ""));
            editPassword.setText(loginPreferences.getString("password", ""));
            cBoxRemember.setChecked(true);
        }else {

        }

        btLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                memCode = editUsername.getText().toString();
                password = editPassword.getText().toString();

                if (TextUtils.isEmpty(memCode)) {
                    editUsername.setError("Nhập username");
                    return;
                }
                if (TextUtils.isEmpty(password)) {
                    editPassword.setError("Nhập password");
                    return;
                }

                //Save username and pass
                if (cBoxRemember.isChecked()) {
                    editorLoginPreferences.putBoolean("statusRemember", true);
                    editorLoginPreferences.putString("username", memCode);
                    editorLoginPreferences.putString("password", password);
                    editorLoginPreferences.commit();
                } else {
                    editorLoginPreferences.clear();
                    editorLoginPreferences.commit();
                }

                new sendLoginRequest().execute();

            }
        });

    }


    public class sendLoginRequest extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... params) {
            aesKey = AESCipher.createKey(password); //create aesKey by password
            editorAESKey.putString("AESKey", aesKey); //save aesKey
            editorAESKey.commit();

            Log.d(TAG, prefsAESKey.getString("AESKey", null));

            try {
                URL loginUrl = new URL(ipManager.getUrl("login"));
                Log.d(TAG, loginUrl.toString());

                JSONObject postDataParams = new JSONObject();
                postDataParams.put("username", memCode);
                String pass = AESCipher.encrypt(aesKey, password); //encrypt password
                Log.d(TAG, pass);
                postDataParams.put("password", pass);
                Log.e("params", postDataParams.toString());


                HttpURLConnection conn = (HttpURLConnection) loginUrl.openConnection();

                conn.setReadTimeout(150000); //milliseconds
                conn.setConnectTimeout(150000);

                conn.setRequestMethod("POST");
                conn.setDoInput(true);
                conn.setDoOutput(true);

                OutputStream os = conn.getOutputStream();
                BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(os, "UTF-8"));
                writer.write(getPostDataString(postDataParams));
                writer.flush();
                writer.close();
                os.close();

                int responseCode = conn.getResponseCode();
                if (responseCode == HttpsURLConnection.HTTP_OK) {
                    BufferedReader in = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                    StringBuffer sb = new StringBuffer("");
                    String line = "";

                    while ((line = in.readLine()) != null) {
                        sb.append(line);
                        break;
                    }

                    in.close();
                    return sb.toString();
                } else {
                    return new String("False: " + responseCode);
                }
            } catch (Exception e) {
                return new String("Exception: " + e.getMessage());
            }
        }

        @Override
        protected void onPostExecute(String s) {
            Log.d(TAG, s);

            try {
                JSONObject jsonObject = new JSONObject(s);

                String token = jsonObject.getString("access_token");
                Log.d(TAG, token);

                accessToken = new AccessToken();
                accessToken.setTokenType(jsonObject.getString("access_token"));
                accessToken.setExpiresIn(dateManager.getAfterDay(30));
                accessToken.setAccessToken(jsonObject.getString("access_token"));
                accessToken.setRefreshToken(jsonObject.getString("refresh_token"));

                tokenManager.saveToken(accessToken);

                Log.d(TAG, "Access token: " + accessToken.getAccessToken());
                Log.d(TAG, "Refresh token: " + accessToken.getRefreshToken());
                Log.d(TAG, "Expire: " + accessToken.getExpiresIn());

                Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                startActivity(intent);
                finish();

            } catch (JSONException e) {
                e.printStackTrace();
                Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
            }


        }
    }

    public class sendGetLogoutRequest extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... params) {
            String result = new GetRequest(ipManager.getUrl("logout"), tokenManager.getToken().getAccessToken()).get();
            return result;
        }

        @Override
        protected void onPostExecute(String s) {
//            super.onPostExecute(s);
            Log.d(TAG, s);
            tokenManager.deleteToken();


        }
    }


    /**
     * convert JSONObject to encode url string format
     * getPostDataString: encoding a string to be used in a query part of a URL
     *
     * @param params
     * @return
     * @throws Exception
     */
    public String getPostDataString(JSONObject params) throws Exception {
        StringBuilder result = new StringBuilder();
        boolean first = true;

        Iterator<String> itr = params.keys();

        while (itr.hasNext()) {
            String key = itr.next();
            Object value = params.get(key);
            if (first)
                first = false;
            else
                result.append("&");

            result.append(URLEncoder.encode(key, "UTF-8"));
            result.append("=");
            result.append(URLEncoder.encode(value.toString(), "UTF-8"));
        }
        return result.toString();
    }

    public void forgotPassword(View view) {
        Toast.makeText(getApplicationContext(), "Forgot pass", Toast.LENGTH_LONG).show();
    }

    public void messengerDialog(String messenger) {
        AlertDialog.Builder alertDialog = new AlertDialog.Builder(LoginActivity.this);
        alertDialog.setMessage(messenger);
        alertDialog.setTitle("Lỗi đăng nhập");
        alertDialog.setPositiveButton("Thoát", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });

        AlertDialog alert = alertDialog.create();
        alert.show();

    }

    //    Menu setting ip address
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.login_setting, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.settingIP:
                ipSetting();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    /**
     * Setting ip server
     */
    public void ipSetting() {
        AlertDialog.Builder builder = new AlertDialog.Builder(LoginActivity.this);
        LayoutInflater inflater = LoginActivity.this.getLayoutInflater();

        View settingView = inflater.inflate(R.layout.dialog_setting_ip_address, null);

        builder.setView(settingView);
        builder.setTitle("Setting IP address");

        final EditText editIP = (EditText) settingView.findViewById(R.id.edit_ip);
        final TextView textIP = (TextView) settingView.findViewById(R.id.tv_ip);
        if (ipManager.getIp() != null)
            textIP.setText(ipManager.getIp());

        builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                ip = editIP.getText().toString();
                if (ip != null) {
                    ipManager.saveIp(ip);
                } else {
                    Toast.makeText(getApplicationContext(), "Chưa nhập địa chỉ IP", Toast.LENGTH_SHORT).show();
                }

            }
        })
                .setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                    }
                });
        AlertDialog alert = builder.create();
        alert.show();
    }


}
