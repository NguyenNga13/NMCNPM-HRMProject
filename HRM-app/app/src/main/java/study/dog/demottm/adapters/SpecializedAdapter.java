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
import study.dog.demottm.entities.Specialized;

/**
 * Created by Nguyen Nga on 24/09/2017.
 */

public class SpecializedAdapter extends ArrayAdapter<Specialized> {

    Context context;
    int resource;
    List<Specialized> objects;
    Specialized specialized;

    public SpecializedAdapter(@NonNull Context context, @LayoutRes int resource, @NonNull List<Specialized> objects) {
        super(context, resource, objects);
        this.context = context;
        this.resource = resource;
        this.objects = objects;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View viewrow = inflater.inflate(R.layout.item_specialized, parent, false);

        TextView tvSpecialized = (TextView)viewrow.findViewById(R.id.tv_specialized);
        TextView tvLevel = (TextView)viewrow.findViewById(R.id.tv_level);
        TextView tvDegree = (TextView)viewrow.findViewById(R.id.tv_degree);
        TextView tvTime = (TextView)viewrow.findViewById(R.id.tv_training_time);
        TextView tvIssuedBy = (TextView)viewrow.findViewById(R.id.tv_issued_by);

        specialized = objects.get(position);
        tvSpecialized.setText(specialized.getSpecialized());
        tvDegree.setText(specialized.getDegree());
        tvLevel.setText(specialized.getLevel());
        tvTime.setText(specialized.getBegin() + " : " + specialized.getFinish());
        tvIssuedBy.setText(specialized.getIssuedBy());

        return viewrow;
    }
}
