package study.dog.demottm;

import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import study.dog.demottm.crypt.AESCipher;
import study.dog.demottm.request.GetRequest;
import study.dog.demottm.adapters.ImageLoadTask;
import study.dog.demottm.adapters.PositionAdapter;
import study.dog.demottm.entities.Position;
import study.dog.demottm.entities.SummaryInfo;
import study.dog.demottm.manager.IpManager;
import study.dog.demottm.manager.SummaryInfoManager;

public class PositionActivity extends AppCompatActivity {

    String memCode;
    String memName, memImage;

    TextView tvName;
    ImageView imPhotocard;

    TextView tvPosition, tvDepartment, tvDecided, tvNote;

    ArrayList<Position> positionList;
    ListView lvPosition;

    TokenManager tokenManager;
    IpManager ipManager;

    SummaryInfo summaryInfo;
    SummaryInfoManager summaryInfoManager;

    SharedPreferences prefsAESKey;

    private static final String TAG = "PositionActivity";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_position);

        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        summaryInfoManager = SummaryInfoManager.getInstance(getSharedPreferences("prefsSummary", MODE_PRIVATE));
        summaryInfo = summaryInfoManager.getSummaryInfo();

        prefsAESKey = getSharedPreferences("prefsAESKey", MODE_PRIVATE);


        tvName = (TextView)findViewById(R.id.tv_name);
        imPhotocard = (ImageView)findViewById(R.id.im_photocard);

        tvPosition = (TextView)findViewById(R.id.tv_position_info);
        tvDepartment = (TextView)findViewById(R.id.tv_department_info);
        tvDecided = (TextView)findViewById(R.id.tv_decided_info);
        tvNote = (TextView)findViewById(R.id.tv_note);

        tvName.setText(summaryInfo.getName());
        new ImageLoadTask(ipManager.getUrlPhotocard(summaryInfo.getPhotocard()), imPhotocard).execute();

        positionList = new ArrayList<Position>();
        lvPosition = (ListView)findViewById(R.id.lv_position);


        new SendGetPositionRequest().execute();
    }

    public class SendGetPositionRequest extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... params) {
            Log.d(TAG, ipManager.getUrl("position"));
            Log.d(TAG, tokenManager.getToken().getAccessToken());
            String result = new GetRequest(ipManager.getUrl("position"), tokenManager.getToken().getAccessToken()).get();
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
                JSONArray jsonArray = new JSONArray(data);

                int lenght = jsonArray.length();
                JSONObject positionJson;

                for(int i = 0; i<lenght; i++){
                    positionJson = jsonArray.getJSONObject(i);

                    String finish = positionJson.getString("date_finish");
                    String status = positionJson.getString("status");
                    if(finish.equals("null") && status.equals("1")){
                        tvPosition.setText(positionJson.getString("position"));
                        tvDepartment.setText(positionJson.getString("department"));
                        tvDecided.setText(positionJson.getString("decided_number"));
                        String note = positionJson.getString("note");
                        if(note.equals("null"))
                            tvNote.setText("");
                        else
                            tvNote.setText(note);

                    }else {
                        Position position = new Position();
                        position.setPosition(positionJson.getString("position"));
                        position.setDepartment(positionJson.getString("department"));
                        position.setBegin(positionJson.getString("date_begin"));
                        position.setFinish(finish);
                        position.setStatus(status);
                        position.setDecided(positionJson.getString("decided_number"));
                        positionList.add(position);
                    }

                    Log.d(TAG, positionJson.getString("position"));
                }

                PositionAdapter adapter = new PositionAdapter(PositionActivity.this, R.layout.item_position, positionList);
                lvPosition.setAdapter(adapter);

            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }

//    private String requestData(String u, String m) {
//        HttpClient httpClient = new DefaultHttpClient();
//
//        // URL của trang web nhận request
//        HttpPost httpPost = new HttpPost(u);
//
//        // Các tham số truyền
//        List nameValuePair = new ArrayList();
//        nameValuePair.add(new BasicNameValuePair("memCode", m));
//
//        //Encoding POST data
//        try {
//            httpPost.setEntity(new UrlEncodedFormEntity(nameValuePair));
//        } catch (UnsupportedEncodingException e) {
//            e.printStackTrace();
//        }
//
//        String result = "";
//        try {
//            HttpResponse response = httpClient.execute(httpPost);
//            HttpEntity entity = response.getEntity();
//            result = EntityUtils.toString(entity);
//        } catch (ClientProtocolException e) {
//            e.printStackTrace();
//        } catch (IOException e) {
//            e.printStackTrace();
//        }
//
//        return result;
//    }
//
//
//    class callWebservice extends AsyncTask<String, Integer, String> {
//        @Override
//        protected String doInBackground(String... params) {
//            return requestData(params[0], memCode);
//        }
//
//        @Override
//        protected void onPostExecute(String s) {
//            if(s.length() == 0){
//                Toast.makeText(getApplicationContext(), "Can't connect to server!", Toast.LENGTH_SHORT).show();
//            }
////            Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();
//            try {
//                JSONArray jsonArray = new JSONArray(s);
//                JSONObject jsonObject = jsonArray.getJSONObject(0);
//                String position, depart, date, addr, phone, fax;
//                position = jsonObject.getString("position");
//                depart = "Phòng " + jsonObject.getString("depart");
//                date = jsonObject.getString("date");
//                addr = jsonObject.getString("addrDepart");
//                phone = jsonObject.getString("phoneDepart");
//                fax = jsonObject.getString("faxDepart");
//
//                tvPosition.setText(position);
//                tvDepart.setText(depart);
//                tvDate.setText(date);
//                tvAddr.setText(addr);
//                tvPhone.setText(phone);
//                tvFax.setText(fax);
//
//            } catch (JSONException e) {
//                e.printStackTrace();
//            }
//
//
//        }
//    }
}
