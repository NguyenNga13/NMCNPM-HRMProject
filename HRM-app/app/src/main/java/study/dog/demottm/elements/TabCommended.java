package study.dog.demottm.elements;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;
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

import study.dog.demottm.CommendedActivity;
import study.dog.demottm.R;
import study.dog.demottm.adapters.Commended;
import study.dog.demottm.adapters.CommendedAdapter;


/**
 * Created by Nguyen Nga on 20/06/2017.
 */

public class TabCommended extends Fragment {

    ListView lvCommended;
    String memCode;
    ArrayList<Commended> commendedList;

    public TabCommended(ArrayList<Commended> commendedList) {
        this.commendedList = commendedList;
    }


    public ArrayList<Commended> getCommendedList() {
        return commendedList;
    }

    public void setCommendedList(ArrayList<Commended> commendedList) {
        this.commendedList = commendedList;
    }
//
//    @Override
//    public void onCreate(@Nullable Bundle savedInstanceState) {
//        super.onCreate(savedInstanceState);
//       // commendedList.add(new Commended("2016-07-06", true, "Khen Thưởng", "Nhân viên xuất sắc", "26/QD-NNH", "", 2000000 ));
//    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.layout_tab_commended, container, false);
        TextView textView = (TextView)rootView.findViewById(R.id.tv);
        textView.setText("1");
      //  lvCommended = (ListView)rootView.findViewById(R.id.lv_commended);
//        Commended commended = commendedList.get(0);
//        Toast.makeText(getContext(), commended.getDate(), Toast.LENGTH_SHORT).show();


//        CommendedAdapter adapter = new CommendedAdapter(this.getActivity(), R.layout.layout_commended_item, commendedList);
//        lvCommended.setAdapter(adapter);
        return rootView;
    }



}
