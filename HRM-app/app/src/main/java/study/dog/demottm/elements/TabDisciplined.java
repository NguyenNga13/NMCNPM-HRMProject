package study.dog.demottm.elements;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import study.dog.demottm.R;


/**
 * Created by Nguyen Nga on 20/06/2017.
 */

public class TabDisciplined extends Fragment {
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.layout_tab_disciplined, container, false);

        return rootView;
    }
}
