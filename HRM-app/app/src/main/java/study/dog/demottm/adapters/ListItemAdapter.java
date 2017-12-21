package study.dog.demottm.adapters;

import android.content.Context;
import android.support.annotation.NonNull;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.List;

import study.dog.demottm.R;

/**
 * Created by Nguyen Nga on 21/04/2017.
 */

public class ListItemAdapter extends ArrayAdapter<ItemMenu> {
    Context context;
    int res;
    List<ItemMenu> list;
    ItemMenu item;

    public ListItemAdapter(Context context, int res, List<ItemMenu> list) {
        super(context, res, list);
        this.context = context;
        this.res = res;
        this.list = list;
    }

    @NonNull
    @Override
    public View getView(int position, View convertView, ViewGroup viewParent) {
        LayoutInflater inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View viewrow = inflater.inflate(R.layout.item_menu_nav, viewParent, false);
        ImageView image = (ImageView)viewrow.findViewById(R.id.image);
        TextView text = (TextView)viewrow.findViewById(R.id.tv_name);
        item = list.get(position);
        image.setImageResource(item.getIcon());
        text.setText(item.getName());
        return viewrow;
    }
}
