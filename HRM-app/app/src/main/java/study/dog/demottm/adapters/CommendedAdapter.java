package study.dog.demottm.adapters;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

import study.dog.demottm.CommendedActivity;
import study.dog.demottm.R;
import study.dog.demottm.elements.TabCommended;

/**
 * Created by Nguyen Nga on 19/06/2017.
 */

public class CommendedAdapter extends ArrayAdapter<Commended> {
    Context context;
    TabCommended tabCommended;
    int res;
    List<Commended> objects;
    Commended commended;
    public CommendedAdapter(Context context, int res, List<Commended> objects) {
        super(context, res, objects);
        this.context = context;
        this.res = res;
        this.objects = objects;
    }

    @NonNull
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        LayoutInflater inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View view = inflater.inflate(R.layout.layout_commended_item, parent, false);

        TextView tvDate = (TextView)view.findViewById(R.id.tv_dateOf_commended);
        TextView tvNum = (TextView)view.findViewById(R.id.tv_numOf_commended);
        TextView tvForm = (TextView)view.findViewById(R.id.tv_form);
        TextView tvValue = (TextView)view.findViewById(R.id.tv_value);
        TextView tvReason = (TextView)view.findViewById(R.id.tv_reason);

        commended = objects.get(position);
        if(commended.isType()){
            tvValue.setText("Thưởng: " + commended.getValue() + " VNĐ");
        }else {
            tvValue.setText("Phạt: " + commended.getValue() + " VNĐ");
        }
        tvDate.setText(commended.getDate());
        tvNum.setText("Số: " + commended.getNum());
        tvForm.setText("Hình thức: " + commended.getForm());
        tvReason.setText("Lý do: " + commended.getReason());
        return view;
    }
}
