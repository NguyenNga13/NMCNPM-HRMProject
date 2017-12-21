package study.dog.demottm;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.design.widget.NavigationView;
import android.support.design.widget.TabLayout;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;

import android.widget.ImageView;
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
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

import javax.net.ssl.HttpsURLConnection;

import study.dog.demottm.adapters.ImageLoadTask;
import study.dog.demottm.entities.SummaryInfo;
import study.dog.demottm.manager.CodeManager;
import study.dog.demottm.manager.IpManager;
import study.dog.demottm.manager.SummaryInfoManager;
import study.dog.demottm.request.GetRequest;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener{

    /**
     * The {@link android.support.v4.view.PagerAdapter} that will provide
     * fragments for each of the sections. We use a
     * {@link FragmentPagerAdapter} derivative, which will keep every
     * loaded fragment in memory. If this becomes too memory intensive, it
     * may be best to switch to a
     * {@link android.support.v4.app.FragmentStatePagerAdapter}.
     */
    private SectionsPagerAdapter mSectionsPagerAdapter;

    /**
     * The {@link ViewPager} that will host the section contents.
     */
    private ViewPager mViewPager;
    TextView tvMemCode, tvMemName;
    ImageView imCardImage;
    public String memCode;

    String urlImage = "";

    TokenManager tokenManager;
    IpManager ipManager;
    SummaryInfoManager summaryInfoManager;

    CodeManager codeManager;

    private static final String TAG = "MainActivity";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        // Create the adapter that will return a fragment for each of the three
        // primary sections of the activity.
        mSectionsPagerAdapter = new SectionsPagerAdapter(getSupportFragmentManager());

        // Set up the ViewPager with the sections adapter.
        mViewPager = (ViewPager) findViewById(R.id.container);
        mViewPager.setAdapter(mSectionsPagerAdapter);

        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
        tabLayout.setupWithViewPager(mViewPager);


        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));
        summaryInfoManager = SummaryInfoManager.getInstance(getSharedPreferences("prefsSummary", MODE_PRIVATE));

        codeManager = new CodeManager();




//        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
//        fab.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
//                        .setAction("Action", null).show();
//            }
//        });

          /*---------------draw nav---------------------*/
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.main_content);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.navigation_view);
        navigationView.setNavigationItemSelectedListener(this);

        //set Name and memCode in navHeaderView
        View header = navigationView.getHeaderView(0);

        tvMemCode = (TextView)header.findViewById(R.id.tv_memcode_nav);
        tvMemName = (TextView)header.findViewById(R.id.tv_name_nav);
        imCardImage = (ImageView) header.findViewById(R.id.im_photocard);
//
//        Bundle blGetAcc = getIntent().getBundleExtra("Account");
//        memCode = blGetAcc.getString("memCode");
//        tvMemCode.setText(memCode);



       // urlImage = "http://192.168.0.102:8080/hrm/image/personel/cardimage/N0001.jpg";
       // imPhotocard.setImageResource(R.drawable.icon_user);

//        runOnUiThread(new Runnable() {
//            @Override
//            public void run() {
//               // new CallServiceBrief(memCode).execute("http://192.168.0.102:8080/hrm/service/JSONLogin.php");
//                LocalhostLink link = new LocalhostLink("hrm/service/JSONInfoSummary.php");
//                new callServiceSum().execute(link.getLink());
//               // new callServiceSum().execute("http://192.168.0.103:8080/hrm/service/JSONInfoSummary.php");
//            }
//        });


        new sendGetInfoRequest().execute();

    }

    @Override
    protected void onResume() {
        super.onResume();
//        new ImageLoadTask(urlImage, imPhotocard).execute();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
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

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.main_content);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        int id = item.getItemId();
       // Bundle blAcc = new Bundle();
        if (id == R.id.nav_home) {
            //...........
        } else if (id == R.id.nav_profile) {
            Intent intentProfileActivity = new Intent(MainActivity.this, ProfileActivity.class);
            startActivity(intentProfileActivity);
        } else if (id == R.id.nav_salary) {
            Intent intentSalaryActivity = new Intent(MainActivity.this, SalaryActivity.class);
            startActivity(intentSalaryActivity);
        } else if (id == R.id.nav_account_settings) {
            Intent intentAccManageActivity = new Intent(MainActivity.this, AccManageActivity.class);
            startActivity(intentAccManageActivity);
        }else if(id == R.id.nav_notify){
            Intent intentPayActivity = new Intent(MainActivity.this, PayActivity.class);
            startActivity(intentPayActivity);
        }else if (id == R.id.nav_logout) {
            Intent intentLoginActivity = new Intent(MainActivity.this, LoginActivity.class);
            Bundle blLogout = new Bundle();
            blLogout.putBoolean("logout", true);
            intentLoginActivity.putExtras(blLogout);
            startActivity(intentLoginActivity);
            finish();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.main_content);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }


    /**
     * A placeholder fragment containing a simple view.
     */
    public static class PlaceholderFragment extends Fragment {
        /**
         * The fragment argument representing the section number for this
         * fragment.
         */
        private static final String ARG_SECTION_NUMBER = "section_number";

        public PlaceholderFragment() {
        }

        /**
         * Returns a new instance of this fragment for the given section
         * number.
         */
        public static PlaceholderFragment newInstance(int sectionNumber) {
            PlaceholderFragment fragment = new PlaceholderFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            fragment.setArguments(args);
            return fragment;
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            View rootView = inflater.inflate(R.layout.fragment_main, container, false);
            TextView textView = (TextView) rootView.findViewById(R.id.section_label);
            textView.setText(getString(R.string.section_format, getArguments().getInt(ARG_SECTION_NUMBER)));
            return rootView;
        }
    }

    /**
     * A {@link FragmentPagerAdapter} that returns a fragment corresponding to
     * one of the sections/tabs/pages.
     */
    public class SectionsPagerAdapter extends FragmentPagerAdapter {

        public SectionsPagerAdapter(FragmentManager fm) {
            super(fm);
        }

        @Override
        public Fragment getItem(int position) {
            // getItem is called to instantiate the fragment for the given page.
            // Return a PlaceholderFragment (defined as a static inner class below).
            return PlaceholderFragment.newInstance(position + 1);
        }

        @Override
        public int getCount() {
            // Show 3 total pages.
            return 3;
        }

        @Override
        public CharSequence getPageTitle(int position) {
            switch (position) {
                case 0:
                    return "TỔNG HỢP";
                case 1:
                    return "ĐÀO TẠO";
                case 2:
                    return "TUYỂN DỤNG";
            }
            return null;
        }
    }

    class callServiceSum extends AsyncTask<String, Integer, String>{

        @Override
        protected String doInBackground(String... params) {
            return requestData(params[0], memCode);
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


    public class sendGetInfoRequest extends AsyncTask<String, Void, String>{

        @Override
        protected String doInBackground(String... params) {
            try {
                URL summaryUrl = new URL(ipManager.getUrl("summary"));
                HttpURLConnection connect = (HttpURLConnection)summaryUrl.openConnection();
                connect.setRequestMethod("GET");
                String auth = "Bearer " + tokenManager.getToken().getAccessToken();
                Log.d(TAG, auth);
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
                    return new String("Request not worked -  " + responseCode);
                }

            } catch (Exception e) {
                Log.d(TAG,"Exception: " + e.getMessage());
                return new String("Exception");
            }
        }

        @Override
        protected void onPostExecute(String s) {
//            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
            Log.d(TAG, s);

//            nếu không kết nối đc với server Exception ->xóa token, trở lại trang login
            try {
                JSONObject jsonObject = new JSONObject(s);
                Log.d(TAG, jsonObject.getString("data"));

                JSONObject profileJson = new JSONObject(jsonObject.getString("data"));
//                JSONArray jsonArray = new JSONArray(jsonObject.getString("data"));
//                int length = jsonArray.length();
//                Log.d(TAG, "Length: " + length);
//                JSONObject profileJson = jsonArray.getJSONObject(0);
                int code = Integer.parseInt(profileJson.getString("id"));
                SummaryInfo summaryInfo = new SummaryInfo(codeManager.convertCode(code), profileJson.getString("name"),profileJson.getString("photo_card"));
                tvMemName.setText(summaryInfo.getName());
                tvMemCode.setText(summaryInfo.getCode());
                urlImage = ipManager.getUrlPhotocard(summaryInfo.getPhotocard());
                new ImageLoadTask(urlImage, imCardImage).execute();

                summaryInfoManager.saveSummaryInfo(summaryInfo);


            } catch (JSONException e) {
                e.printStackTrace();

//                Logout khi không kết nối đc vs server --- chưa làm
                if(s.equals("Exception")){
                    tokenManager.deleteToken();
                    Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                    startActivity(intent);
                    Toast.makeText(getApplicationContext(), "Can't connnect to server!", Toast.LENGTH_LONG).show();
                }else {
                    Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
                }
            }

        }
    }

//    public class sendGetLogoutRequest extends  AsyncTask<String, Void, String>{
//
//        @Override
//        protected String doInBackground(String... params) {
//            String result = new GetRequest(ipManager.getUrl("logout"), tokenManager.getToken().getAccessToken()).get();
//            return  result;
//        }
//
//        @Override
//        protected void onPreExecute() {
//            super.onPreExecute();
//
//        }
//
//        @Override
//        protected void onPostExecute(String s) {
////            super.onPostExecute(s);
//            Log.d(TAG, s);
//
//            tokenManager.deleteToken();
//            Intent intentLoginActivity = new Intent(MainActivity.this, LoginActivity.class);
//            startActivity(intentLoginActivity);
//
//        }
//    }

}
