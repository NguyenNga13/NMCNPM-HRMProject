package study.dog.demottm;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.NonNull;
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
import android.widget.ExpandableListView;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import study.dog.demottm.adapters.ExpandListProfileAdapter;
import study.dog.demottm.entities.Profile;
import study.dog.demottm.request.GetRequest;
import study.dog.demottm.adapters.ImageLoadTask;
import study.dog.demottm.entities.SummaryInfo;
import study.dog.demottm.manager.IpManager;
import study.dog.demottm.manager.SummaryInfoManager;

public class ProfileActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    String memCode;

    TextView tvMemCode, tvMemName;
    ImageView imCardImage;

    TextView tvCodePro, tvNamePro, tvTitlePro;
    ImageView imCardPro;

    ExpandListProfileAdapter listProfileApdapter;
    ExpandableListView exListView;
    List<String> listHeaderProfile;
    HashMap<String, List<String>> listChildProfile;

    String urlImage;

    SummaryInfoManager summaryInfoManager;
    SummaryInfo summaryInfo;
    IpManager ipManager;
    TokenManager tokenManager;

    SharedPreferences prefsDegree;
    SharedPreferences.Editor editorDegree;

    private static final String TAG = "ProfileActivity";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
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

        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        summaryInfoManager = SummaryInfoManager.getInstance(getSharedPreferences("prefsSummary", MODE_PRIVATE));
        summaryInfo = summaryInfoManager.getSummaryInfo();


        prefsDegree = getSharedPreferences("prefsDegree", MODE_PRIVATE);
        editorDegree = prefsDegree.edit();
        new SendGetDegreeRequest().execute();

        tvMemCode = (TextView) header.findViewById(R.id.tv_memcode_nav);
        tvMemName = (TextView) header.findViewById(R.id.tv_name_nav);
        imCardImage = (ImageView) header.findViewById(R.id.im_photocard);


        tvMemCode.setText(summaryInfo.getCode());
        tvMemName.setText(summaryInfo.getName());
        urlImage = ipManager.getUrlPhotocard(summaryInfo.getPhotocard());
        Log.d(TAG, urlImage);
        new ImageLoadTask(urlImage, imCardImage).execute();

        tvCodePro = (TextView) findViewById(R.id.tv_code_profile);
        tvCodePro.setText(summaryInfo.getCode());

        tvNamePro = (TextView) findViewById(R.id.tv_name_profile);
        tvNamePro.setText(summaryInfo.getName());

        tvTitlePro = (TextView) findViewById(R.id.tv_tittle_profile);

        imCardPro = (ImageView) findViewById(R.id.im_photocard);
        new ImageLoadTask(urlImage, imCardPro).execute();

        //set expand list
        exListView = (ExpandableListView) findViewById(R.id.exlistview_profile);
        prepareListDataProfile();
        listProfileApdapter = new ExpandListProfileAdapter(this, listHeaderProfile, listChildProfile);

        exListView.setAdapter(listProfileApdapter);

        //alaways expand groups
        for (int i = 0; i < listProfileApdapter.getGroupCount(); i++) {
            exListView.expandGroup(i);
        }

        // Listview Group click listener
//        exListView.setOnGroupClickListener(new ExpandableListView.OnGroupClickListener() {
//            @Override
//            public boolean onGroupClick(ExpandableListView parent, View v, int groupPosition, long id) {
//                return false;
//            }
//        });

        // Listview on child click listener
        exListView.setOnChildClickListener(new ExpandableListView.OnChildClickListener() {

            @Override
            public boolean onChildClick(ExpandableListView parent, View v,
                                        int groupPosition, int childPosition, long id) {
                // TODO Auto-generated method stub
                Toast.makeText(
                        getApplicationContext(),
                        listHeaderProfile.get(groupPosition)
                                + " : "
                                + listChildProfile.get(
                                listHeaderProfile.get(groupPosition)).get(
                                childPosition), Toast.LENGTH_SHORT)
                        .show();
                if (groupPosition == 0 && childPosition == 0) {
                    Intent intentpersonalInfoActivity = new Intent(ProfileActivity.this, PersonalInfoActivity.class);
                    startActivity(intentpersonalInfoActivity);
//                    finish();
                }else if (groupPosition == 0 && childPosition == 1) {
                    Intent intentRelatives = new Intent(ProfileActivity.this, RelativesActivity.class);
                    startActivity(intentRelatives);
                }else if(groupPosition == 0 && childPosition == 2){
                    Intent intentDegreeActivity = new Intent(ProfileActivity.this, DegreeActivity.class);
                    startActivity(intentDegreeActivity);
                }else if (groupPosition == 1 && childPosition == 0) {
                    Intent intentPositionActivity = new Intent(ProfileActivity.this, PositionActivity.class);
                    startActivity(intentPositionActivity);
                } else if (groupPosition == 1 && childPosition == 1 ) {
                    Intent intentCommendedActivity = new Intent(ProfileActivity.this, CommendedActivity.class);
                    startActivity(intentCommendedActivity);
                } else if (groupPosition == 2) {

                }
                return false;
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
        getMenuInflater().inflate(R.menu.profile, menu);
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
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        int id = item.getItemId();
        if (id == R.id.nav_home) {
            Intent intentMainActivity = new Intent(ProfileActivity.this, MainActivity.class);
            startActivity(intentMainActivity);
        } else if (id == R.id.nav_profile) {
            //.............
        } else if (id == R.id.nav_salary) {
            Intent intentSalaryActivity = new Intent(ProfileActivity.this, SalaryActivity.class);
            startActivity(intentSalaryActivity);
        } else if (id == R.id.nav_account_settings) {
            Intent intentAccManageActivity = new Intent(ProfileActivity.this, AccManageActivity.class);
            startActivity(intentAccManageActivity);
        } else if (id == R.id.nav_notify) {

        } else if (id == R.id.nav_logout) {
            Intent intentLoginActivity = new Intent(ProfileActivity.this, LoginActivity.class);
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

    private void prepareListDataProfile() {
        listHeaderProfile = new ArrayList<String>();
        listChildProfile = new HashMap<String, List<String>>();

        // Adding group data
        listHeaderProfile.add("Thông tin cá nhân");
        listHeaderProfile.add("Quá trình công tác");
        listHeaderProfile.add("Hợp đồng lao động");

        //Adding child data
        List<String> infomation = new ArrayList<>();
        infomation.add("Thông tin cá nhân");
        infomation.add("Thông tin gia đình");
        infomation.add("Trình độ - bằng cấp");

        List<String> work = new ArrayList<>();
        work.add("Chức vụ công tác");
        work.add("Khen thưởng kỷ luật");

        List<String> degree = new ArrayList<>();
        degree.add("Chuyên môn");
        degree.add("Ngoại ngữ");
//        degree.add("Tin học");

        List<String> contract = new ArrayList<>();

        listChildProfile.put(listHeaderProfile.get(0), infomation);
        listChildProfile.put(listHeaderProfile.get(1), work);
        listChildProfile.put(listHeaderProfile.get(2), contract);
    }


    public class SendGetDegreeRequest extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... params) {
            String result = new GetRequest(ipManager.getUrl("degree"), tokenManager.getToken().getAccessToken()).get();
            return  result;
        }

        @Override
        protected void onPostExecute(String s) {
            editorDegree.putString("DEGREE", s).commit();
            Log.d(TAG, "Back? " + prefsDegree.getString("DEGREE", null));
        }
    }


}
