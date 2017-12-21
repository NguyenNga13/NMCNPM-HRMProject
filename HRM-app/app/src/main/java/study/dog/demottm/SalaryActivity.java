package study.dog.demottm;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
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
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import study.dog.demottm.adapters.AllowanceAdapter;
import study.dog.demottm.adapters.ImageLoadTask;
import study.dog.demottm.crypt.AESCipher;
import study.dog.demottm.entities.Allowance;
import study.dog.demottm.entities.SummaryInfo;
import study.dog.demottm.manager.IpManager;
import study.dog.demottm.manager.SummaryInfoManager;
import study.dog.demottm.request.GetRequest;

public class SalaryActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    private static final String TAG = "SalaryActivity";

    TokenManager tokenManager;
    IpManager ipManager;

    SummaryInfoManager summaryInfoManager;
    SummaryInfo summaryInfo;

    SharedPreferences prefsAESKey;

    String memCode;
    String urlImage;
    TextView tvMemCode, tvMemName;
    ImageView imCardImage;

    TextView tvPayRange, tvBeginOfPayRange, tvPayRate, tvPayValue, tvInsurance, tvBeginOfInsurance;
    ListView lvAllowance;
    ArrayList<Allowance> allowanceList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_salary);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
//                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
//                        .setAction("Action", null).show();
                Intent intentPaySheetActivity = new Intent(SalaryActivity.this, PaySheetActivity.class);
                startActivity(intentPaySheetActivity);
            }
        });

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.setDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        View header = navigationView.getHeaderView(0);


        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        summaryInfoManager = SummaryInfoManager.getInstance(getSharedPreferences("prefsSummary", MODE_PRIVATE));
        summaryInfo = summaryInfoManager.getSummaryInfo();

        prefsAESKey = getSharedPreferences("prefsAESKey", MODE_PRIVATE);

        tvMemCode = (TextView) header.findViewById(R.id.tv_memcode_nav);
        tvMemName = (TextView) header.findViewById(R.id.tv_name_nav);
        imCardImage = (ImageView) header.findViewById(R.id.im_photocard);

        tvMemCode.setText(summaryInfo.getCode());
        tvMemName.setText(summaryInfo.getName());
        urlImage = ipManager.getUrlPhotocard(summaryInfo.getPhotocard());
        new ImageLoadTask(urlImage, imCardImage).execute();

        tvPayRange = (TextView)findViewById(R.id.tv_payrange);
        tvBeginOfPayRange = (TextView)findViewById(R.id.tv_begin_of_payrange);
        tvPayRate = (TextView)findViewById(R.id.tv_payrate);
        tvPayValue = (TextView)findViewById(R.id.tv_payvalue);
        tvInsurance = (TextView)findViewById(R.id.tv_insurance_code);
        tvBeginOfInsurance = (TextView)findViewById(R.id.tv_begin_of_insurance);

        lvAllowance = (ListView)findViewById(R.id.lv_allowance);

        allowanceList = new ArrayList<Allowance>();

        new SendGetSalaryRequest().execute();
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
        getMenuInflater().inflate(R.menu.salary, menu);
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
            Intent intentMainActivity = new Intent(SalaryActivity.this, MainActivity.class);
            startActivity(intentMainActivity);
        } else if (id == R.id.nav_profile) {
            Intent intentProfileActivity = new Intent(SalaryActivity.this, ProfileActivity.class);
            startActivity(intentProfileActivity);

        } else if (id == R.id.nav_salary) {
//            Intent intentSalaryActivity = new Intent(SalaryActivity.this, SalaryActivity.class);
//            startActivity(intentSalaryActivity);

        } else if (id == R.id.nav_account_settings) {
            Intent intentAccManageActivity = new Intent(SalaryActivity.this, AccManageActivity.class);
            startActivity(intentAccManageActivity);

        }else if(id == R.id.nav_notify){

        }else if (id == R.id.nav_logout) {
            Intent intentLoginActivity = new Intent(SalaryActivity.this, LoginActivity.class);
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

    public class SendGetSalaryRequest extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... params) {
            Log.d(TAG, ipManager.getUrl("salary"));
            Log.d(TAG, tokenManager.getToken().getAccessToken());
            String result = new GetRequest(ipManager.getUrl("salary"), tokenManager.getToken().getAccessToken()).get();
            return  result;
        }

        @Override
        protected void onPostExecute(String s) {
//            super.onPostExecute(s);
            Log.d(TAG, s);
            String aesKey = prefsAESKey.getString("AESKey", null);

            try {
                JSONObject jsonObject = new JSONObject(s);
                String data = AESCipher.decrypt(aesKey, jsonObject.getString("data"));
                Log.d(TAG, data);

                JSONObject salaryObject = new JSONObject(data);


                Log.d(TAG, salaryObject.getString("name"));
                tvPayRange.setText(salaryObject.getString("pay_range"));
                tvBeginOfPayRange.setText(salaryObject.getString("salary_begin"));
                tvPayRate.setText(salaryObject.getString("pay_rate"));
                tvPayValue.setText(salaryObject.getString("pay_value"));
                tvInsurance.setText(salaryObject.getString("insurance_code"));
                tvBeginOfInsurance.setText(salaryObject.getString("date_begin_insurance"));

                JSONArray allowanceArray = new JSONArray(salaryObject.getString("allowance"));
                int length = allowanceArray.length();
                JSONObject allowanceObject;

                for(int i = 0; i < length; i++){
                    allowanceObject = allowanceArray.getJSONObject(i);

                    Allowance allowance = new Allowance(
                            allowanceObject.getString("id"),
                            allowanceObject.getString("allowance"),
                            allowanceObject.getString("allowance_code"),
                            allowanceObject.getString("allowance_level"),
                            allowanceObject.getString("allowance_rate"),
                            allowanceObject.getString("allowance_value"),
                            allowanceObject.getString("allowance_begin"),
                            allowanceObject.getString("allowance_finish")
                    );
                    allowanceList.add(allowance);
                }

                AllowanceAdapter adapter = new AllowanceAdapter(SalaryActivity.this, R.layout.item_allowance, allowanceList);
                lvAllowance.setAdapter(adapter);

                //                PositionAdapter adapter = new PositionAdapter(PositionActivity.this, R.layout.item_position, positionList);
//                lvPosition.setAdapter(adapter);


//                JSONArray jsonArray = new JSONArray(data);
//
//                int lenght = jsonArray.length();
//                JSONObject positionJson;
//
//                for(int i = 0; i<lenght; i++){
//                    positionJson = jsonArray.getJSONObject(i);
//
//                    String finish = positionJson.getString("date_finish");
//                    String status = positionJson.getString("status");
//                    if(finish.equals("null") && status.equals("1")){
//                        tvPosition.setText(positionJson.getString("position"));
//                        tvDepartment.setText(positionJson.getString("department"));
//                        tvDecided.setText(positionJson.getString("decided_number"));
//                        String note = positionJson.getString("note");
//                        if(note.equals("null"))
//                            tvNote.setText("");
//                        else
//                            tvNote.setText(note);
//
//                    }else {
//                        Position position = new Position();
//                        position.setPosition(positionJson.getString("position"));
//                        position.setDepartment(positionJson.getString("department"));
//                        position.setBegin(positionJson.getString("date_begin"));
//                        position.setFinish(finish);
//                        position.setStatus(status);
//                        position.setDecided(positionJson.getString("decided_number"));
//                        positionList.add(position);
//                    }
//
//                    Log.d(TAG, positionJson.getString("position"));
//                }
//
//                PositionAdapter adapter = new PositionAdapter(PositionActivity.this, R.layout.item_position, positionList);
//                lvPosition.setAdapter(adapter);
//
            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }
}
