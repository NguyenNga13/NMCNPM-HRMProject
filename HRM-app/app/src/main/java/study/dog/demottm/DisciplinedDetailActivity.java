package study.dog.demottm;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ListView;
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
import study.dog.demottm.adapters.CommendedAdapter;
import study.dog.demottm.elements.LocalhostLink;

public class DisciplinedDetailActivity extends AppCompatActivity {

    String memCode;
    ArrayList<Commended> disciplinedList;
    ListView lvDisciplinedDetail;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_disciplined_detail);

        Bundle blGetAcc = getIntent().getBundleExtra("Account");
        memCode = blGetAcc.getString("memCode");
        lvDisciplinedDetail = (ListView)findViewById(R.id.lv_disciplined_detail);

        disciplinedList = new ArrayList<Commended>();

        runOnUiThread(new Runnable() {
            @Override
            public void run() {
                LocalhostLink link = new LocalhostLink("hrm/service/JSONGetCommendedByCode.php");
                new callWebservice().execute(link.getLink());
               // new callWebservice().execute("http://192.168.0.103:8080/hrm/service/JSONGetCommendedByCode.php");
            }
        });
    }



    public class callWebservice extends AsyncTask<String, Integer, String> {
        @Override
        protected String doInBackground(String... params) {
            return requestData(params[0], memCode);
        }

        @Override
        protected void onPostExecute(String s) {
           // Toast.makeText(getApplicationContext(), s, Toast.LENGTH_SHORT).show();
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
                    if (Integer.parseInt(jsonObject.getString("type")) == 0) {
                        disciplinedList.add(new Commended(date, false, form, reason, num, document, value));
                    }
                }
                CommendedAdapter adapter = new CommendedAdapter(DisciplinedDetailActivity.this, R.layout.layout_commended_item, disciplinedList);
                lvDisciplinedDetail.setAdapter(adapter);


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
