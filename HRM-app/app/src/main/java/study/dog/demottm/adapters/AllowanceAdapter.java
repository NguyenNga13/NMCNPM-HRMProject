package study.dog.demottm.adapters;

import android.content.Context;
import android.support.annotation.LayoutRes;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.List;

import study.dog.demottm.R;
import study.dog.demottm.entities.Allowance;

/**
 * Created by Nguyen Nga on 15/12/2017.
 */

public class AllowanceAdapter extends ArrayAdapter<Allowance> {

    Context context;
    int resource;
    List<Allowance> objects;
    Allowance allowance;

    public AllowanceAdapter(@NonNull Context context, @LayoutRes int resource, @NonNull List<Allowance> objects) {
        super(context, resource, objects);
        this.context = context;
        this.resource = resource;
        this.objects = objects;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View viewrow = inflater.inflate(R.layout.item_allowance, parent, false);

        TextView tvAllowance = (TextView)viewrow.findViewById(R.id.tv_allowance);
        TextView tvAllowanceLevel = (TextView)viewrow.findViewById(R.id.tv_allowance_level);
        TextView tvAllowanceValueLabel = (TextView)viewrow.findViewById(R.id.tv_allowance_value_label);
        TextView tvAllowanceValue = (TextView)viewrow.findViewById(R.id.tv_allowance_value);
        TextView tvAllowanceBegin = (TextView)viewrow.findViewById(R.id.tv_allowance_begin);
        TextView tvAllowanceFinish = (TextView)viewrow.findViewById(R.id.tv_allowance_finish);

        allowance = objects.get(position);
        tvAllowance.setText(allowance.getAllowance());
        tvAllowanceLevel.setText(allowance.getAllowanceLevel());
        if(!allowance.getAllowanceRate().equals("")){
            tvAllowanceValueLabel.setText("Hệ số");
            tvAllowanceValue.setText(allowance.getAllowanceRate());
        }else if(!allowance.getAllowanceValue().equals("")){
            tvAllowanceValueLabel.setText("Giá trị");
            tvAllowanceValue.setText(allowance.getAllowanceValue());
        }
        tvAllowanceBegin.setText(allowance.getAllowanceBegin());
        tvAllowanceFinish.setText(allowance.getAllowanceFinish());

        return viewrow;
    }
}
