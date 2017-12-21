package study.dog.demottm.adapters;

import android.content.ContentProvider;
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
import study.dog.demottm.entities.Language;

/**
 * Created by Nguyen Nga on 24/09/2017.
 */

public class LanguageAdapter  extends ArrayAdapter<Language>{

    Context context;
    int resource;
    List<Language> objects;
    Language language;

    public LanguageAdapter(@NonNull Context context, @LayoutRes int resource, @NonNull List<Language> objects) {
        super(context, resource, objects);
        this.context = context;
        this.resource = resource;
        this.objects = objects;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {

        LayoutInflater inflater = (LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View viewrow = inflater.inflate(R.layout.item_language, parent, false);

        TextView tvLanguage = (TextView)viewrow.findViewById(R.id.tv_language);
        TextView tvCetificate = (TextView)viewrow.findViewById(R.id.tv_cerfiticate);
        TextView tvLevel = (TextView)viewrow.findViewById(R.id.tv_level_language);
        TextView tvIssuedBy = (TextView)viewrow.findViewById(R.id.tv_issued_by_language);
        TextView tvDateOfIssued = (TextView)viewrow.findViewById(R.id.tv_dateOf_issued_language);
        TextView tvExpire = (TextView)viewrow.findViewById(R.id.tv_expire_language);

        language = objects.get(position);

        tvLanguage.setText(language.getLanguage());
        tvCetificate.setText(language.getCertificate());
        tvIssuedBy.setText(language.getIssuedBy());
        tvDateOfIssued.setText(language.getDateOfIssued());
        tvExpire.setText(language.getExpired());
        tvLevel.setText(language.getLevel());

        return viewrow;
    }
}
