package study.dog.demottm;

import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.View;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
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

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

import study.dog.demottm.adapters.ImageLoadTask;
import study.dog.demottm.adapters.ItemMenu;
import study.dog.demottm.adapters.ListItemAdapter;
import study.dog.demottm.elements.LocalhostLink;
import study.dog.demottm.entities.SummaryInfo;
import study.dog.demottm.manager.IpManager;
import study.dog.demottm.manager.SummaryInfoManager;

public class AccManageActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    String memCode;
    String urlImage;

    TextView tvMemCode, tvMemName;
    ImageView imCardImage;

    SummaryInfoManager summaryInfoManager;
    SummaryInfo summaryInfo;

    IpManager ipManager;
    TokenManager tokenManager;

    ArrayList<ItemMenu> arrayItem;
    ListView lvItem;

    private Dialog dialog;
    String oldPassword, newPassword, renewPassword;
    String messenger;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_acc_manage);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

//        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
//        fab.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
//                        .setAction("Action", null).show();
//            }
//        });

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        View header = navigationView.getHeaderView(0);

        summaryInfoManager = SummaryInfoManager.getInstance(getSharedPreferences("prefsSummary", MODE_PRIVATE));
        summaryInfo = summaryInfoManager.getSummaryInfo();
        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        tvMemCode = (TextView)header.findViewById(R.id.tv_memcode_nav);
        tvMemName = (TextView)header.findViewById(R.id.tv_name_nav);
        imCardImage = (ImageView) header.findViewById(R.id.im_photocard);

        tvMemCode.setText(summaryInfo.getCode());
        tvMemName.setText(summaryInfo.getName());
        urlImage = ipManager.getUrlPhotocard(summaryInfo.getPhotocard());
        new ImageLoadTask(urlImage, imCardImage).execute();

        lvItem = (ListView)findViewById(R.id.lv_item);
        arrayItem = new ArrayList<ItemMenu>();
        setArrayItem();
        ListItemAdapter adapter = new ListItemAdapter(this, R.layout.item_menu_nav, arrayItem);
        lvItem.setAdapter(adapter);

        lvItem.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                Toast.makeText(getApplicationContext(), "get " + position, Toast.LENGTH_SHORT).show();

                switch (position){
                    case 0:
                        break;
                    case 1:
                        dialog = new Dialog(AccManageActivity.this);
                        dialog.setTitle("Đổi mật khẩu");
                        dialog.setContentView(R.layout.layout_change_password);
                        final EditText editOldPassword = (EditText)dialog.findViewById(R.id.edit_old_password);
                        final EditText editNewPassword = (EditText)dialog.findViewById(R.id.edit_new_password);
                        final EditText editRenewPassword = (EditText)dialog.findViewById(R.id.edit_renew_password);
                        final TextView tvWarning = (TextView)dialog.findViewById(R.id.tv_warning);
                        Button btCancel = (Button)dialog.findViewById(R.id.bt_cancel);
                        btCancel.setOnClickListener(new View.OnClickListener() {
                            @Override
                            public void onClick(View v) {
                                dialog.dismiss();
                            }
                        });

                        Button btSave = (Button)dialog.findViewById(R.id.bt_save);
                        btSave.setOnClickListener(new View.OnClickListener() {
                            @Override
                            public void onClick(View v) {
                                newPassword = editNewPassword.getText().toString();
                                renewPassword = editRenewPassword.getText().toString();
                                oldPassword = editOldPassword.getText().toString();
                                if(oldPassword.isEmpty() || newPassword.isEmpty() || renewPassword.isEmpty())
                                    tvWarning.setText("Nhập vào thông tin");
                                else if(newPassword.compareTo(renewPassword) != 0){
                                    tvWarning.setText("Mật khẩu nhập lại không đúng");
                                }else {

                                }
                                dialog.dismiss();
                            }
                        });
                        dialog.show();
                        break;
                    case 2:
                        AlertDialog.Builder alertDialog = new AlertDialog.Builder(AccManageActivity.this);
                        alertDialog.setMessage("Bạn muốn đăng xuất?");
                        alertDialog.setPositiveButton("Có", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                Intent intentLoginActivity = new Intent(AccManageActivity.this, LoginActivity.class);
                                Bundle blLogout = new Bundle();
                                blLogout.putBoolean("logout", true);
                                intentLoginActivity.putExtras(blLogout);
                                startActivity(intentLoginActivity);
                                finish();
                            }
                        });

                        alertDialog.setNegativeButton("Không", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialog, int which) {
                                dialog.dismiss();
                            }
                        });

                        AlertDialog alert  = alertDialog.create();
                        alert.show();
                        break;

                }

            }
        });

    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.acc_manage, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();
        if (id == R.id.nav_home) {
            Intent intentMainActivity = new Intent(AccManageActivity.this, MainActivity.class);
            startActivity(intentMainActivity);
        } else if (id == R.id.nav_profile) {
            Intent intentProfileActivity = new Intent(AccManageActivity.this, ProfileActivity.class);
            startActivity(intentProfileActivity);
        } else if (id == R.id.nav_salary) {
            Intent intentSalaryActivity = new Intent(AccManageActivity.this, SalaryActivity.class);
            startActivity(intentSalaryActivity);
        } else if (id == R.id.nav_account_settings) {
//            Intent intentAccManageActivity = new Intent(AccManageActivity.this, AccManageActivity.class);
//            startActivity(intentAccManageActivity);
        }else if(id == R.id.nav_notify){

        }else if (id == R.id.nav_logout) {
            Intent intentLoginActivity = new Intent(AccManageActivity.this, LoginActivity.class);
            Bundle blLogout = new Bundle();
            blLogout.putBoolean("logout", true);
            intentLoginActivity.putExtras(blLogout);
            startActivity(intentLoginActivity);
            finish();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

    public void setArrayItem(){
        arrayItem = new ArrayList<ItemMenu>();
        arrayItem.add(new ItemMenu(R.drawable.icon_menu_account_settings, "Thông tin tài khoản"));
        arrayItem.add(new ItemMenu(R.drawable.icon_change_password, "Đổi mật khẩu"));
        arrayItem.add(new ItemMenu(R.drawable.icon_logout, "Đăng xuất"));
    }


    private String requestData(String u, String memCode, String oldPassword, String newPassword) {
        HttpClient httpClient = new DefaultHttpClient();

        // URL của trang web nhận request
        HttpPost httpPost = new HttpPost(u);

        // Các tham số truyền
        List nameValuePair = new ArrayList();
        nameValuePair.add(new BasicNameValuePair("memCode", memCode));
        nameValuePair.add(new BasicNameValuePair("oldPassword", oldPassword));
        nameValuePair.add(new BasicNameValuePair("newPassword", newPassword));

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

    class callWebservice extends AsyncTask<String, Integer, String> {

        @Override
        protected String doInBackground(String... params) {
            return requestData(params[0], memCode, oldPassword, newPassword);
        }

        @Override
        protected void onPostExecute(String s) {
            messenger = s;
//            Toast.makeText(getApplicationContext(), messenger, Toast.LENGTH_LONG).show();
            messengerDialog(messenger);
        }
    }

    public void messengerDialog(String messenger){
        AlertDialog.Builder alertDialog = new AlertDialog.Builder(AccManageActivity.this);
        alertDialog.setMessage(messenger);
        alertDialog.setPositiveButton("Thoát", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });

        AlertDialog alert  = alertDialog.create();
        alert.show();

    }

    class callServiceSum extends AsyncTask<String, Integer, String>{

        @Override
        protected String doInBackground(String... params) {
            return requestDataSum(params[0], memCode);
        }

        @Override
        protected void onPostExecute(String s) {
            try {
                JSONArray jsonArray = new JSONArray(s);
                JSONObject jsonObject = jsonArray.getJSONObject(0);

                tvMemName.setText(jsonObject.getString("memName"));
                new ImageLoadTask(jsonObject.getString("cardImage"), imCardImage).execute();
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

    private String requestDataSum(String u, String m) {
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
