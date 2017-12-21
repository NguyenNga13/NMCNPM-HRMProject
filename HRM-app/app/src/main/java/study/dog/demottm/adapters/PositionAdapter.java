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
import study.dog.demottm.entities.Position;

/**
 * Created by Nguyen Nga on 23/09/2017.
 */

public class PositionAdapter extends ArrayAdapter<Position> {

    Context context;
    int resource;
    List<Position> objects;
    Position empPos;

    public PositionAdapter(@NonNull Context context, @LayoutRes int resource, @NonNull List<Position> objects) {
        super(context, resource, objects);
        this.context = context;
        this.resource = resource;
        this.objects = objects;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View view, @NonNull ViewGroup parent) {
        LayoutInflater inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View viewrow = inflater.inflate(R.layout.item_position, parent, false);


        TextView tvTime = (TextView)viewrow.findViewById(R.id.tv_time);
        TextView tvPosition = (TextView)viewrow.findViewById(R.id.tv_position_item);
        TextView tvDepartment = (TextView)viewrow.findViewById(R.id.tv_department_item);
        TextView tvDecided = (TextView)viewrow.findViewById(R.id.tv_decided_item);
        TextView tvStatus = (TextView)viewrow.findViewById(R.id.tv_status_item);

//        empPos = objects.get(position);
        empPos = objects.get(position);
        tvTime.setText(empPos.getBegin() + " : " +empPos.getFinish());
        tvPosition.setText(empPos.getPosition());
        tvDepartment.setText(empPos.getDepartment());
        if(empPos.getStatus().equals("1"))
            tvStatus.setText("Chính thức");
        else
            tvStatus.setText("Kiêm nhiệm");
        tvDecided.setText("Quyết định: " + empPos.getDecided());

        return viewrow;
    }
}
