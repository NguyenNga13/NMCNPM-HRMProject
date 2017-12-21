package study.dog.demottm.adapters;

import android.content.Context;
import android.support.annotation.LayoutRes;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.List;

import study.dog.demottm.R;
import study.dog.demottm.entities.Relatives;

/**
 * Created by Nguyen Nga on 22/09/2017.
 */

public class RelativesAdapter extends ArrayAdapter<Relatives> {
    Context context;
    int resource;
    List<Relatives> objects;
    Relatives relatives;
    public RelativesAdapter(@NonNull Context context, @LayoutRes int resource, @NonNull List<Relatives> objects) {
        super(context, resource, objects);
        this.context = context;
        this.resource = resource;
        this.objects = objects;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View view, @NonNull ViewGroup parent) {
        LayoutInflater inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        View viewrow = inflater.inflate(R.layout.item_relatives, parent, false);
        ImageView imIcon = (ImageView)viewrow.findViewById(R.id.im_icon_relatives);
        TextView tvName = (TextView)viewrow.findViewById(R.id.tv_name_relatives);
        TextView tvRelatinship = (TextView)viewrow.findViewById(R.id.tv_relationship);
        TextView tvDateOfBirth = (TextView)viewrow.findViewById(R.id.tv_dateOf_birth_relatves_info);
        TextView tvCareer = (TextView)viewrow.findViewById(R.id.tv_career_relatves_info);
        TextView tvWorkplace = (TextView)viewrow.findViewById(R.id.tv_workplace_relatves_info);
        TextView tvPhone = (TextView)viewrow.findViewById(R.id.tv_phone_relatves_info);
        TextView tvAddress = (TextView)viewrow.findViewById(R.id.tv_address_relatves_info);

        relatives = objects.get(position);
        String relationship = relatives.getRelationship();
        tvName.setText(relatives.getName());
        tvRelatinship.setText(relationship);
        tvDateOfBirth.setText(relatives.getDateOfBirth());
        tvCareer.setText(relatives.getCareer());
        tvWorkplace.setText(relatives.getWorkplace());
        tvPhone.setText(relatives.getPhone());
        tvAddress.setText(relatives.getAddress());
        if(relationship.equals("Bố"))
            imIcon.setImageResource(R.drawable.icon_father);
        else if(relationship.equals("Mẹ"))
            imIcon.setImageResource(R.drawable.icon_mother);
        else if(relationship.equals("Vợ"))
            imIcon.setImageResource(R.drawable.icon_wife);
        else if(relationship.equals("Chồng"))
            imIcon.setImageResource(R.drawable.icon_husband);
        else if(relationship.equals("Anh trai") || relationship.equals("Em trai"))
            imIcon.setImageResource(R.drawable.icon_brother);
        else if(relationship.equals("Chị gái") || relationship.equals("Em gái"))
            imIcon.setImageResource(R.drawable.icon_sister);
        else if (relationship.equals("Con trai"))
            imIcon.setImageResource(R.drawable.icon_son);
        else if(relationship.equals("Con gái"))
            imIcon.setImageResource(R.drawable.icon_daughter);
        else
            imIcon.setImageResource(R.drawable.icon_unknow);
        return viewrow;
    }
}
