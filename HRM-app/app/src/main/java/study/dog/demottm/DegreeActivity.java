package study.dog.demottm;

import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.design.widget.TabLayout;
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

import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import study.dog.demottm.crypt.AESCipher;
import study.dog.demottm.request.GetRequest;
import study.dog.demottm.adapters.LanguageAdapter;
import study.dog.demottm.adapters.SpecializedAdapter;
import study.dog.demottm.entities.Language;
import study.dog.demottm.entities.Position;
import study.dog.demottm.entities.Specialized;
import study.dog.demottm.manager.IpManager;

public class DegreeActivity extends AppCompatActivity {

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

    private String[] tabs = {"Chuyên môn", "Ngoại ngữ"};
    private TabLayout tabLayout;

    public static int[] resourceIds = {
            R.layout.fragment_specialized,
            R.layout.fragment_language
    };

    TokenManager tokenManager;
    IpManager ipManager;

    SharedPreferences prefsDegree;
    SharedPreferences.Editor editorDegree;

    SharedPreferences prefsAESKey;

    private static final String TAG = "DegreeActivity";

    public String data;
    Position pos;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_degree);

        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        prefsAESKey = getSharedPreferences("prefsAESKey", MODE_PRIVATE);

        prefsDegree = getSharedPreferences("prefsDegree", MODE_PRIVATE);
        editorDegree = prefsDegree.edit();

        Log.d(TAG, "Data save? : " + prefsDegree.getString("DEGREE", null));
//        new SendGetDegreeRequest().execute();


        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        // Create the adapter that will return a fragment for each of the three
        // primary sections of the activity.

        mSectionsPagerAdapter = new SectionsPagerAdapter(getSupportFragmentManager());
//        mSectionsPagerAdapter = new SectionsPagerAdapter(getSupportFragmentManager(), "Ngu ngốc...");

        // Set up the ViewPager with the sections adapter.
        mViewPager = (ViewPager) findViewById(R.id.container);
        mViewPager.setAdapter(mSectionsPagerAdapter);

        tabLayout = (TabLayout) findViewById(R.id.tabs);
        tabLayout.setupWithViewPager(mViewPager);


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
        getMenuInflater().inflate(R.menu.menu_degree, menu);
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
        public static PlaceholderFragment newInstance(int sectionNumber, String string, String aesKey) {
            PlaceholderFragment fragment = new PlaceholderFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            args.putString("degree", string);
            args.putString("aesKey", aesKey);
            fragment.setArguments(args);
            return fragment;
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
//            View rootView = inflater.inflate(R.layout.fragment_degree, container, false);
//            TextView textView = (TextView) rootView.findViewById(R.id.section_label);
//            textView.setText(getString(R.string.section_format, getArguments().getInt(ARG_SECTION_NUMBER)));
//            Context context = inflater.getContext();

            int index = getArguments().getInt(ARG_SECTION_NUMBER);

            String s = getArguments().getString("degree");
            String aesKey = getArguments().getString("aesKey");
            View rootView = inflater.inflate(resourceIds[index], container, false);

            ListView lvSpecialized = (ListView)rootView.findViewById(R.id.lv_specialized);
            ListView lvLanguage = (ListView)rootView.findViewById(R.id.lv_language);
            ArrayList<Specialized> specializedList = new ArrayList<Specialized>();
            ArrayList<Language> languagesList = new ArrayList<Language>();


            Log.d(TAG, "Degree : " + s);
            Log.d(TAG, "AESKey : " + aesKey);


//            if (index == 0) {
//                Log.d(TAG, "Specialized : " + s);
//            } else if (index == 1) {
//                Log.d(TAG, "Language : " + s);
//            }
            if(!s.equals("")){
                Log.d(TAG, "!= null");
            }
            try {

                JSONObject jsonObject = new JSONObject(s);


                String data = AESCipher.decrypt(aesKey, jsonObject.getString("data"));
                Log.d("DATA: ", data);

                JSONObject jsonObjectData =  new JSONObject(data);
                Log.d(TAG, jsonObjectData.toString());


                JSONArray jsonArraySpecialized = new JSONArray(jsonObjectData.getString("specialized"));
                Log.d("SPECIALIZED: ", jsonArraySpecialized.toString());
                JSONArray jsonArrayLanguege = new JSONArray(jsonObjectData.getString("language"));
                Log.d("LANGUAGE: ", jsonArrayLanguege.toString());
                if (index == 0) {
                    Log.d(TAG, "Specialized : " +jsonArraySpecialized.toString());

                    int lenght = jsonArraySpecialized.length();
                    JSONObject specializedJson;
                    for (int i = 0; i < lenght; i++){
                        specializedJson = jsonArraySpecialized.getJSONObject(i);

                        Specialized specialized = new Specialized();
                        specialized.setSpecialized(specializedJson.getString("specialized"));
                        specialized.setDegree(specializedJson.getString("degree"));
                        specialized.setLevel(specializedJson.getString("level"));
                        specialized.setIssuedBy(specializedJson.getString("issued_by"));
                        specialized.setBegin(specializedJson.getString("begin"));
                        specialized.setFinish(specializedJson.getString("finish"));

                        specializedList.add(specialized);
                    }

                    SpecializedAdapter adapter = new SpecializedAdapter(getActivity(), R.layout.item_specialized, specializedList);
                    lvSpecialized.setAdapter(adapter);
                }else if(index == 1){

                    Log.d(TAG, "Language : " +jsonArrayLanguege.toString());
                    int len = jsonArrayLanguege.length();
                    JSONObject languageJson;
                    for(int i = 0; i< len; i++){
                        languageJson = jsonArrayLanguege.getJSONObject(i);

                        Language language = new Language();
                        language.setLanguage(languageJson.getString("language"));
                        language.setCertificate(languageJson.getString("certificate_type"));
                        language.setLevel(languageJson.getString("level"));
                        language.setIssuedBy(languageJson.getString("issued_by"));
                        language.setDateOfIssued(languageJson.getString("date_of_issued"));
                        language.setExpired(languageJson.getString("expire"));

                        languagesList.add(language);
                    }

                    LanguageAdapter adapterLanguage = new LanguageAdapter(getActivity(), R.layout.item_language, languagesList);
                    lvLanguage.setAdapter(adapterLanguage);
                }


            } catch (JSONException e) {
                e.printStackTrace();
            }


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

            String s = prefsDegree.getString("DEGREE", null);
            String aesKey = prefsAESKey.getString("AESKey", null);
//            editorDegree.clear().commit();
            Log.d(TAG, "Clear: ? " + prefsDegree.getString("DEGREE", null));
            return PlaceholderFragment.newInstance(position, s, aesKey);
        }


        @Override
        public int getCount() {
            // Show 3 total pages.
            return 2;
        }

        @Override
        public CharSequence getPageTitle(int position) {
//            switch (position) {
//                case 0:
//                    return "Chuyên môn";
//                case 1:
//                    return "Ngoại ngữ";
//                case 2:
//                    return "Tin học";
//            }
            return tabs[position];
        }
    }


    public class SendGetDegreeRequest extends AsyncTask<String, Void, String> {

        String dataPos;


        @Override
        protected String doInBackground(String... params) {

            Log.d(TAG, ipManager.getUrl("position"));
            Log.d(TAG, tokenManager.getToken().getAccessToken());
            String result = new GetRequest(ipManager.getUrl("position"), tokenManager.getToken().getAccessToken()).get();
            this.dataPos = result;

//            editorDegreePreferences.putString("LANGUAGE", result).commit();
//            mSectionsPagerAdapter.setS(result);
            return result;
        }

        @Override
        protected void onPostExecute(String s) {
//            super.onPostExecute(s);
//            this.dataPos = s;


            data = s;
            Log.d(TAG, "Before: " + data);
            try {
                JSONObject jsonObject = new JSONObject(s);
                JSONArray jsonArray = new JSONArray(jsonObject.getString("data"));

                JSONObject positionJson;
                positionJson = jsonArray.getJSONObject(0);

                pos.setPosition(positionJson.getString("position"));
                pos.setDepartment(positionJson.getString("department"));
                pos.setBegin(positionJson.getString("date_begin"));
                pos.setFinish(positionJson.getString("date_finish"));
                pos.setStatus(positionJson.getString("status"));
                pos.setDecided(positionJson.getString("decided_number"));


            } catch (JSONException e) {
                e.printStackTrace();
            }


        }

        public String getDataPos() {
            return dataPos;
        }

    }


}
