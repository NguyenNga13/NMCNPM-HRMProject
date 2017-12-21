package study.dog.demottm;

import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import study.dog.demottm.crypt.AESCipher;
import study.dog.demottm.request.GetRequest;
import study.dog.demottm.adapters.RelativesAdapter;
import study.dog.demottm.entities.Relatives;
import study.dog.demottm.manager.IpManager;

public class RelativesActivity extends AppCompatActivity {

    TokenManager tokenManager;
    IpManager ipManager;

    ArrayList<Relatives> relativesList;
    ListView lvRelatives;

    SharedPreferences prefsAESKey;

    private static final String TAG = "RelativesActivity";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_relatives);

        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        prefsAESKey = getSharedPreferences("prefsAESKey", MODE_PRIVATE);

        relativesList = new ArrayList<Relatives>();
        lvRelatives = (ListView)findViewById(R.id.lv_relatives);


        new SendGetRelativesRequest().execute();
    }


    public class SendGetRelativesRequest extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... params) {
            Log.d(TAG, ipManager.getUrl("relatives"));
            Log.d(TAG, tokenManager.getToken().getAccessToken());
            String data = new GetRequest(ipManager.getUrl("relatives"), tokenManager.getToken().getAccessToken()).get();
            return  data;
//            try {
//                URL profileUrl = new URL(urlManager.getUrl("relatives"));
//
//                HttpURLConnection connect = (HttpURLConnection)profileUrl.openConnection();
//                connect.setRequestMethod("GET");
//                String auth = "Bearer " + tokenManager.getToken().getAccessToken();
//                connect.setRequestProperty("Authorization", auth);
//
//                int responseCode = connect.getResponseCode();
//                System.out.println("GET response code :: " + responseCode);
//
//                if(responseCode == HttpsURLConnection.HTTP_OK){
//                    BufferedReader in = new BufferedReader(new InputStreamReader(connect.getInputStream()));
//                    String inputLine;
//                    StringBuffer response = new StringBuffer();
//                    while ((inputLine = in.readLine()) != null){
//                        response.append(inputLine);
//                    }
//                    in.close();
//                    System.out.println(response.toString());
//                    return response.toString();
//                }else {
//                    System.out.print("GET request not worked");
//                    return new String("GET request not worked - code: " + responseCode);
//                }
//
//            } catch (Exception e) {
//                System.out.print("Exception: " + e.getMessage());
//                return new String("Exception: " + e.getMessage());
//            }
        }

        @Override
        protected void onPostExecute(String s) {
            Log.d(TAG, s);

            String aesKey = prefsAESKey.getString("AESKey", null);

            try {
                JSONObject jsonObject = new JSONObject(s);

                String data = AESCipher.decrypt(aesKey, jsonObject.getString("data"));
                JSONArray jsonArray = new JSONArray(data);

                int lenght = jsonArray.length();
                JSONObject relativesJson;
                for(int i =0; i<lenght; i++){
                    Relatives relatives = new Relatives();
                    relativesJson = jsonArray.getJSONObject(i);
                    relatives.setName(relativesJson.getString("name"));
                    relatives.setRelationship(relativesJson.getString("relationship"));
                    relatives.setDateOfBirth(relativesJson.getString("date_of_birth"));
                    relatives.setCareer(relativesJson.getString("career"));
                    relatives.setWorkplace(relativesJson.getString("workplace"));
                    relatives.setPhone(relativesJson.getString("phone"));
                    JSONObject addr = new JSONObject(relativesJson.getString("address"));
                    relatives.setAddress(addr.getString("address") + ", " + addr.getString("district") + ", " + addr.getString("province"));
                    relativesList.add(relatives);
                    Log.d(TAG, relativesJson.getString("name"));
                }
                RelativesAdapter adater = new RelativesAdapter(RelativesActivity.this, R.layout.item_relatives, relativesList);
                lvRelatives.setAdapter(adater);
            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }
}
