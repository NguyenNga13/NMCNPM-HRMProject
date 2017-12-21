package study.dog.demottm;

import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
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

import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

import study.dog.demottm.crypt.AESCipher;
import study.dog.demottm.request.GetRequest;
import study.dog.demottm.adapters.ImageLoadTask;
import study.dog.demottm.entities.SummaryInfo;
import study.dog.demottm.manager.IpManager;
import study.dog.demottm.manager.SummaryInfoManager;

public class PersonalInfoActivity extends AppCompatActivity {

    String memCode;
    TextView tvMemCode, tvMemName, tvGender, tvPhone, tvMail, tvAddr, tvDateOfBirth;
    ImageView imPhotocard;

    TextView tvCountry, tvIdCard, tvDateOfICard, tvPlaceOfIcard, tvPassport, tvDateOfPassport, tvPlaceOfPassport, tvExpirePassport;
    TextView tvPlaceOfBirth, tvEthnic, tvReligion, tvHouseholdAddr, tvMarialStatus, tvDateOfAdherent,
            tvSocialIns, tvHealthIns, tvBankAccount, tvDepartCode, tvPosition, tvWorkCode;

    SummaryInfoManager summaryInfoManager;
    SummaryInfo summaryInfo;

    TokenManager tokenManager;
    IpManager ipManager;

    SharedPreferences prefsAESKey;


    private static final String TAG = "PersonallInfoActivity";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_personal_info);

        tvMemCode = (TextView)findViewById(R.id.tv_mem_code_info);
        tvMemName = (TextView)findViewById(R.id.tv_name);
        imPhotocard = (ImageView)findViewById(R.id.im_photocard);

        tvGender = (TextView)findViewById(R.id.tv_gender_info);
        tvPhone = (TextView)findViewById(R.id.tv_phone_info);
        tvMail = (TextView)findViewById(R.id.tv_mail_info);
        tvDateOfBirth = (TextView)findViewById(R.id.tv_dateOfBirth_info);

        tvCountry = (TextView)findViewById(R.id.tv_country_info);
        tvIdCard = (TextView)findViewById(R.id.tv_idCard_info);
        tvDateOfICard = (TextView)findViewById(R.id.tv_dateOf_idCard_info);
        tvPlaceOfIcard = (TextView)findViewById(R.id.tv_placeOf_idCard_info);
        tvPassport = (TextView)findViewById(R.id.tv_passport_info);
        tvDateOfPassport = (TextView)findViewById(R.id.tv_dateOf_passport_info);
        tvPlaceOfPassport = (TextView)findViewById(R.id.tv_placeOf_passport_info);
        tvExpirePassport = (TextView)findViewById(R.id.tv_expire_passport_info);

        tvAddr = (TextView)findViewById(R.id.tv_address_info);
        tvPlaceOfBirth = (TextView)findViewById(R.id.tv_placeOfBirth_info);
        tvEthnic = (TextView)findViewById(R.id.tv_ethnic_info);
        tvReligion = (TextView)findViewById(R.id.tv_religion_info);
        tvHouseholdAddr = (TextView)findViewById(R.id.tv_household_addr_info);

        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        summaryInfoManager = SummaryInfoManager.getInstance(getSharedPreferences("prefsSummary", MODE_PRIVATE));

        prefsAESKey = getSharedPreferences("prefsAESKey", MODE_PRIVATE);

        summaryInfo = summaryInfoManager.getSummaryInfo();
        tvMemCode.setText(summaryInfo.getCode());
        tvMemName.setText(summaryInfo.getName());
        new ImageLoadTask(ipManager.getUrlPhotocard(summaryInfo.getPhotocard()), imPhotocard).execute();

        new SendGetProfileRequest().execute();

    }


    public class SendGetProfileRequest extends AsyncTask<String, Void, String>{

        @Override
        protected String doInBackground(String... params) {
            String result = new GetRequest(ipManager.getUrl("profile"),tokenManager.getToken().getAccessToken()).get();
            return  result;
//            try {
//                URL profileUrl = new URL(ipManager.getUrl("profile"));
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
            Log.d(TAG, aesKey);

            try {
                JSONObject jsonObject = new JSONObject(s);

                String profile = AESCipher.decrypt(aesKey,jsonObject.getString("data") );

                JSONObject profileJson = new JSONObject(profile);
                Log.d(TAG, profileJson.toString());

                String name = profileJson.getString("name");
                String photocard = profileJson.getString("photo_card");

                if(summaryInfo.getName().compareTo(name) != 0){
                    tvMemName.setText(name);
                    Log.d(TAG, "Change name: " + name);
                }
                if(!summaryInfo.getPhotocard().equals(photocard)){
                    new ImageLoadTask(ipManager.getUrlPhotocard(photocard), imPhotocard).execute();
                    Log.d(TAG, "Change photocard: " + photocard);
                }

                tvDateOfBirth.setText(profileJson.getString("date_of_birth"));
                if(profileJson.getString("gender").equals("1"))
                    tvGender.setText("Nam");
                else
                    tvGender.setText("Nữ");
//                tvGender.setText(profileJson.getString("gender"));
                tvPhone.setText(profileJson.getString("phone"));
                tvMail.setText(profileJson.getString("email"));

                tvCountry.setText(profileJson.getString("country"));
                tvIdCard.setText(profileJson.getString("identity_card"));
                tvDateOfICard.setText(profileJson.getString("id_date_of_issued"));
                tvPlaceOfIcard.setText(profileJson.getString("id_issued_by"));
                tvPassport.setText(profileJson.getString("passport_number"));
                tvDateOfPassport.setText(profileJson.getString("passport_date_of_issued"));
                tvPlaceOfPassport.setText(profileJson.getString("passport_issued_by"));
                tvExpirePassport.setText(profileJson.getString("passport_expiration_date"));

                tvEthnic.setText(profileJson.getString("ethnic"));
                tvReligion.setText(profileJson.getString("religion"));
                JSONObject household_addr = new JSONObject(profileJson.getString("household_address"));
                tvHouseholdAddr.setText(household_addr.getString("address") + ", " + household_addr.getString("district") + ", " + household_addr.getString("province"));
                JSONObject birth_addr = new JSONObject(profileJson.getString("place_of_birth"));
                tvPlaceOfBirth.setText(birth_addr.getString("address") + ", " + birth_addr.getString("district") + ", " + birth_addr.getString("province"));
                JSONObject addr = new JSONObject(profileJson.getString("address"));
                tvAddr.setText(addr.getString("address") + ", " + addr.getString("district") + ", " + addr.getString("province"));
            } catch (JSONException e) {
                e.printStackTrace();
                Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
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

    class callWebservice extends AsyncTask<String, Integer, String> {
        @Override
        protected String doInBackground(String... params) {
           return requestData(params[0], memCode);
        }

        @Override
        protected void onPostExecute(String s) {
            if(s.length() == 0){
                Toast.makeText(getApplicationContext(), "Can't connect to server!", Toast.LENGTH_SHORT).show();
            }
//            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
            try {
                JSONArray jsonArray = new JSONArray(s);
                JSONObject jsonObject = jsonArray.getJSONObject(0);
                String memName, gender, phone, mail, addr;
                memName = jsonObject.getString("memName");
                gender = jsonObject.getString("gender");
                phone = jsonObject.getString("phone");
                mail = jsonObject.getString("mail");
                addr = jsonObject.getString("address");

                tvMemName.setText(memName);
                if(gender.compareTo("1") == 0){
                    tvGender.setText("Nam");
                }else {
                    tvGender.setText("Nữ");
                }

                tvMail.setText(mail);
                tvPhone.setText(phone);
                tvAddr.setText(addr);
                new ImageLoadTask(jsonObject.getString("cardImage"), imPhotocard).execute();

                tvDateOfBirth.setText(jsonObject.getString("dateOfBirth"));
                tvPlaceOfBirth.setText(jsonObject.getString("placeOfBirth"));
                tvIdCard.setText(jsonObject.getString("idCard"));
                tvDateOfICard.setText(jsonObject.getString("dateOfIdCard"));
                tvPlaceOfIcard.setText(jsonObject.getString("placeOfIdCard"));
                tvEthnic.setText(jsonObject.getString("ethnic"));
                tvReligion.setText(jsonObject.getString("religion"));
                tvHouseholdAddr.setText(jsonObject.getString("householdAddr"));
                String marialStatus = jsonObject.getString("marialStatus");
                if(marialStatus.compareTo("1") == 1){
                    tvMarialStatus.setText("Đã kết hôn");
                }else {
                    tvMarialStatus.setText("Độc thân");
                }
                tvDateOfAdherent.setText(jsonObject.getString("dateOfAdherent"));
                tvSocialIns.setText(jsonObject.getString("socialIns"));
                tvHealthIns.setText(jsonObject.getString("healthIns"));
                tvBankAccount.setText(jsonObject.getString("bankAccount"));
            } catch (JSONException e) {
                e.printStackTrace();
            }


        }
    }
}