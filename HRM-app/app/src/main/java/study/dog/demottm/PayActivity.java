package study.dog.demottm;

import android.content.DialogInterface;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DecimalFormat;
import java.text.NumberFormat;

import study.dog.demottm.manager.IpManager;
import study.dog.demottm.request.GetRequest;

public class PayActivity extends AppCompatActivity {

    TokenManager tokenManager;
    IpManager ipManager;

    TextView tvPayValue, tvManday, tvPaidLeave, tvHolidayLeave, tvTotalIncome, tvBHXH, tvBHYT, tvBHTN, tvRealSalary;
    TextView tvAllowanceDegreeLabel, tvAllowanceDegree;
    TextView tvAllowanceResponsibilityLabel, tvAllowanceResponsibility;

    private static final String TAG = "PayActivity";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pay);

        ipManager = IpManager.getInstance(getSharedPreferences("prefs", MODE_PRIVATE));
        tokenManager = TokenManager.getInstance(getSharedPreferences("prefsToken", MODE_PRIVATE));

        tvPayValue = (TextView) findViewById(R.id.tv_payvalue_value);
        tvManday = (TextView) findViewById(R.id.tv_manday_explain);
        tvPaidLeave = (TextView) findViewById(R.id.tv_paid_leave_explain);
        tvHolidayLeave = (TextView) findViewById(R.id.tv_holiday_leave_explain);
        tvTotalIncome = (TextView) findViewById(R.id.tv_total_income_value);
        tvBHXH = (TextView) findViewById(R.id.tv_bhxh_value);
        tvBHYT = (TextView) findViewById(R.id.tv_bhyt_value);
        tvBHTN = (TextView) findViewById(R.id.tv_bhtn_value);
        tvRealSalary = (TextView) findViewById(R.id.tv_real_salary_value);
        tvAllowanceDegreeLabel = (TextView) findViewById(R.id.tv_allowance_degree_label);
        tvAllowanceDegree = (TextView) findViewById(R.id.tv_allowance_degree_value);
        tvAllowanceResponsibilityLabel = (TextView) findViewById(R.id.tv_allowance_responsibility_label);
        tvAllowanceResponsibility = (TextView) findViewById(R.id.tv_allowance_responsibility_value);

        new SendGetPaySheetRequest().execute();
    }


    public class SendGetPaySheetRequest extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... params) {
            String result = new GetRequest(ipManager.getUrl("paysheet"), tokenManager.getToken().getAccessToken()).get();
            return result;
        }

        @Override
        protected void onPostExecute(String s) {
            Log.d(TAG, s);
            try {
                JSONObject jsonObject = new JSONObject(s);

                JSONObject paysheetObject = new JSONObject(jsonObject.getString("data"));
                if (paysheetObject.has("pay_value")) {
                    JSONObject workOject = new JSONObject(paysheetObject.getString("workday"));
//
                    String name = paysheetObject.getString("name");
                    Log.d(TAG, name);

                    NumberFormat formatter = new DecimalFormat("###,###");

                    int pay_value = Integer.parseInt(paysheetObject.getString("pay_value"));
                    tvPayValue.setText(formatter.format(pay_value));
                    tvTotalIncome.setText(formatter.format(Integer.parseInt(paysheetObject.getString("total_income"))));
                    tvBHXH.setText(formatter.format(Integer.parseInt(paysheetObject.getString("bhxh"))));
                    tvBHYT.setText(formatter.format(Integer.parseInt(paysheetObject.getString("bhyt"))));
                    tvBHTN.setText(formatter.format(Integer.parseInt(paysheetObject.getString("bhtn"))));
                    tvRealSalary.setText(formatter.format(Integer.parseInt(paysheetObject.getString("salary"))));

                    tvManday.setText(workOject.getString("man_day"));
                    tvPaidLeave.setText(workOject.getString("paid_leave_day"));
                    tvHolidayLeave.setText(workOject.getString("holiday_leave_day"));

                    JSONArray jsonArray = new JSONArray(paysheetObject.getString("allowances"));
                    int lenght = jsonArray.length();
                    if (lenght == 1) {
                        JSONObject aObject = jsonArray.getJSONObject(0);
                        tvAllowanceDegreeLabel.setText(aObject.getString("allowance"));
                        tvAllowanceDegree.setText(formatter.format(Integer.parseInt(aObject.getString("allowance_value"))));
                        tvAllowanceResponsibilityLabel.setText("");
                        tvAllowanceResponsibility.setText("");
                    } else if (lenght > 1) {
                        JSONObject aObject = jsonArray.getJSONObject(0);
                        tvAllowanceDegreeLabel.setText(aObject.getString("allowance"));
                        tvAllowanceDegree.setText(formatter.format(Integer.parseInt(aObject.getString("allowance_value"))));
                        JSONObject a2Object = jsonArray.getJSONObject(1);
                        tvAllowanceResponsibilityLabel.setText(a2Object.getString("allowance"));
                        tvAllowanceResponsibility.setText(formatter.format(Integer.parseInt(a2Object.getString("allowance_value"))));
                    }
                } else {
                    tvPayValue.setText("");
                    tvTotalIncome.setText("");
                    tvBHXH.setText("");
                    tvBHYT.setText("");
                    tvBHTN.setText("");
                    tvRealSalary.setText("");

                    tvManday.setText("");
                    tvPaidLeave.setText("");
                    tvHolidayLeave.setText("");
                    tvAllowanceDegree.setText("");
                    tvAllowanceResponsibility.setText("");
                    showAlertDialog("Chưa có bảng lương tháng này!");
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }

//            {"data":{"id":14,"id_emp":24,"time":"2017-12-21","pay_value":5694000,
// "allowances":"[{\"id\":28,\"allowance\":\"Ph\\u1ee5 c\\u1ea5p tr\\u00ecnh \\u0111\\u1ed9\",
// \"allowance_code\":\"PCTD\",\"allowance_level\":\"PCTD-2\",\"allowance_begin\":\"2017-02-20\",
// \"allowance_finish\":null,\"allowance_rate\":\"3\",\"allowance_value\":\"240000\"},
// {\"id\":29,\"allowance\":\"Ph\\u1ee5 c\\u1ea5p tr\\u00e1ch nhi\\u1ec7m\",\"allowance_code\":\"PCTN\",
// \"allowance_level\":\"PCTN-1\",\"allowance_begin\":\"2017-02-20\",\"allowance_finish\":null,\"allowance_rate\":\"5\",
// \"allowance_value\":\"500000\"}]","total_income":6434000,"real_income":6434000,
// "insurances":null,"bhxh":514720,"bhyt":96510,"bhtn":64340,"income_tax":null,"prepay":null,"salary":5758430,
// "date_of_payment":null,"created_at":"2017-12-21 00:37:28","updated_at":"2017-12-21 00:37:28","emp_code":"E0024",
// "name":"NGUY\u1ec4N TH\u00d9Y DUNG","position":"Ph\u00f3 ph\u00f2ng","department":"Ph\u00f2ng H\u00e0nh ch\u00ednh - T\u1ed5 ch\u1ee9c",
// "insurance_code":1464781425,"date_begin_insurance":"2017-02-20","workday":{"id":6,"id_emp":24,"time":"2017-12-25",
// "man_day":25,"paid_leave_day":2,"holiday_leave_day":null,"sick_leave_day":null,"created_at":"2017-12-21 00:00:00","updated_at":null}}}
        }
    }

    public void showAlertDialog(String message) {
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Thông báo");
        builder.setMessage(message);
        builder.setCancelable(false);

        builder.setNegativeButton("Thoát", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                dialogInterface.dismiss();
            }
        });
        AlertDialog alertDialog = builder.create();
        alertDialog.show();

    }
}
