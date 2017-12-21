package study.dog.demottm.adapters;

import android.content.Context;
import android.graphics.Typeface;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseExpandableListAdapter;
import android.widget.TextView;

import java.util.HashMap;
import java.util.List;

import study.dog.demottm.R;

/**
 * Created by Nguyen Nga on 14/04/2017.
 */

public class ExpandListProfileAdapter extends BaseExpandableListAdapter {

    private Context _context;
    private List<String> _listProfileHeader; //header title
    private HashMap<String, List<String>> _listProfileChild; //child title

    public ExpandListProfileAdapter(Context _context, List<String> _listProfileHeader, HashMap<String, List<String>> _listProfileChild) {
        this._context = _context;
        this._listProfileHeader = _listProfileHeader;
        this._listProfileChild = _listProfileChild;
    }

    @Override
    public int getGroupCount() {
        return _listProfileHeader.size();
    }

    @Override
    public int getChildrenCount(int groupPosition) {
        return this._listProfileChild.get(this._listProfileHeader.get(groupPosition)).size();
    }

    @Override
    public Object getGroup(int groupPosition) {
        return this._listProfileHeader.get(groupPosition);
    }

    @Override
    public Object getChild(int groupPosition, int childPosition) {
        return this._listProfileChild.get(this._listProfileHeader.get(groupPosition)).get(childPosition);
    }

    @Override
    public long getGroupId(int groupPosition) {
        return groupPosition;
    }

    @Override
    public long getChildId(int groupPosition, int childPosition) {
        return childPosition;
    }

    @Override
    public boolean hasStableIds() {
        return false;
    }

    @Override
    public View getGroupView(int groupPosition, boolean isExpanded, View convertView, ViewGroup parent) {
        String headerTitle = (String) getGroup(groupPosition);
        if(convertView == null){
            LayoutInflater inflater = (LayoutInflater) this._context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.item_profile_group, null);
        }

        TextView tvHeaderItem = (TextView)convertView.findViewById(R.id.tv_header_item);
        tvHeaderItem.setTypeface(null, Typeface.BOLD);
        tvHeaderItem.setText(headerTitle);

        return convertView;
    }

    @Override
    public View getChildView(int groupPosition, int childPosition, boolean isLastChild, View convertView, ViewGroup parent) {
        final String childText = (String) getChild(groupPosition, childPosition);

        if (convertView == null) {
            LayoutInflater infalInflater = (LayoutInflater) this._context
                    .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = infalInflater.inflate(R.layout.item_profile_child, null);
        }

        TextView txtListChild = (TextView) convertView
                .findViewById(R.id.tv_child_item_profile);

        txtListChild.setText(childText);
        return convertView;
    }

    @Override
    public boolean isChildSelectable(int groupPosition, int childPosition) {
        return true;
    }
}
