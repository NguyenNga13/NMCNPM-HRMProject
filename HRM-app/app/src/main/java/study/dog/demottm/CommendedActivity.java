package study.dog.demottm;

import android.os.AsyncTask;
import android.support.design.widget.TabLayout;
import android.support.v4.app.FragmentStatePagerAdapter;
import android.support.v4.view.PagerAdapter;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;

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

import study.dog.demottm.adapters.Commended;
import study.dog.demottm.elements.LocalhostLink;
import study.dog.demottm.elements.TabCommended;
import study.dog.demottm.elements.TabDisciplined;


public class CommendedActivity extends AppCompatActivity {

    public String memCode;
    public ArrayList<Commended> commendedList;
    public ArrayList<Commended> disciplinedList;



    /**
     * The {@link PagerAdapter} that will provide
     * fragments for each of the sections. We use a
     * {@link FragmentPagerAdapter} derivative, which will keep every
     * loaded fragment in memory. If this becomes too memory intensive, it
     * may be best to switch to a
     * {@link FragmentStatePagerAdapter}.
     */
    private SectionsPagerAdapter mSectionsPagerAdapter;

    /**
     * The {@link ViewPager} that will host the section contents.
     */
    private ViewPager mViewPager;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_commended);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);


        commendedList = new ArrayList<Commended>();
        disciplinedList = new ArrayList<Commended>();

//        runOnUiThread(new Runnable() {
//            @Override
//            public void run() {
//
//                LocalhostLink link = new LocalhostLink("hrm/service/JSONGetCommendedByCode.php");
//                new callWebservice().execute(link.getLink());
//                //new callWebservice().execute("http://192.168.0.103:8080/hrm/service/JSONGetCommendedByCode.php");
//            }
//        });


        // Create the adapter that will return a fragment for each of the three
        // primary sections of the activity.

        mSectionsPagerAdapter = new SectionsPagerAdapter(getSupportFragmentManager());

        // Set up the ViewPager with the sections adapter.
        mViewPager = (ViewPager) findViewById(R.id.container);
        mViewPager.setAdapter(mSectionsPagerAdapter);

        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
        tabLayout.setupWithViewPager(mViewPager);

        Toast.makeText(getApplicationContext(), " " + commendedList.size() + " - " + disciplinedList.size(), Toast.LENGTH_SHORT).show();

//        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
//        fab.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
//                        .setAction("Action", null).show();
//            }
//        });

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_commended, menu);
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
            switch (position){
                case 0:
                    TabCommended tab1 = new TabCommended(commendedList);
                    return tab1;
                case 1:
                    TabDisciplined tab2 = new TabDisciplined();
                    return tab2;
                default:
                    return null;
            }

        }

        @Override
        public int getCount() {
            return 2;
        }

        @Override
        public CharSequence getPageTitle(int position) {
            switch (position) {
                case 0:
                    return "Khen thưởng";
                case 1:
                    return "Kỷ luật";
            }
            return null;
        }
    }


    public class callWebservice extends AsyncTask<String, Integer, String> {
        @Override
        protected String doInBackground(String... params) {
            return requestData(params[0], memCode);
        }

        @Override
        protected void onPostExecute(String s) {
            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_SHORT).show();
            if (s.length() == 0) {
                Toast.makeText(getApplicationContext(), "No!", Toast.LENGTH_SHORT).show();
            }

            try {
                JSONArray jsonArray = new JSONArray(s);
                int len = jsonArray.length();
                String num, date, form, reason, document;
                float value;

                for (int i = 0; i < len; i++) {
                    JSONObject jsonObject = jsonArray.getJSONObject(i);
                    num = jsonObject.getString("num");
                    date = jsonObject.getString("date");
                    form = jsonObject.getString("form");
                    reason = jsonObject.getString("reason");
                    document = jsonObject.getString("document");
                    value = Float.parseFloat(jsonObject.getString("value"));
                    if (Integer.parseInt(jsonObject.getString("type")) == 1) {
                        commendedList.add(new Commended(date, true, form, reason, num, document, value));
                    } else {
                        disciplinedList.add(new Commended(date, false, form, reason, num, document, value));
                    }
                }

                Toast.makeText(getApplicationContext(), "n2 - " + commendedList.size() + " - " + disciplinedList.size(), Toast.LENGTH_SHORT).show();

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


}
