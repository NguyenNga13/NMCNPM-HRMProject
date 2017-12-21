package study.dog.demottm.manager;

import android.content.SharedPreferences;

import study.dog.demottm.entities.SummaryInfo;

/**
 * Created by Nguyen Nga on 21/09/2017.
 */

public class SummaryInfoManager {

    private SharedPreferences prefsSummary;
    private SharedPreferences.Editor editor;
    private static SummaryInfoManager INSTANCE = null;

    public SummaryInfoManager(SharedPreferences prefsSummary){
        this.prefsSummary = prefsSummary;
        this.editor = prefsSummary.edit();
    }

    public static synchronized SummaryInfoManager getInstance(SharedPreferences prefsSummary){
        if(INSTANCE == null){
            INSTANCE = new SummaryInfoManager(prefsSummary);
        }
        return INSTANCE;
    }

    public void saveSummaryInfo(SummaryInfo summaryInfo){
        editor.putString("EMP_CODE", summaryInfo.getCode()).commit();
        editor.putString("EMP_NAME", summaryInfo.getName()).commit();
        editor.putString("EMP_PHOTOCARD", summaryInfo.getPhotocard()).commit();
    }

    public SummaryInfo getSummaryInfo()
    {
        String code = prefsSummary.getString("EMP_CODE", null);
        String name = prefsSummary.getString("EMP_NAME", null);
        String photocard = prefsSummary.getString("EMP_PHOTOCARD", null);

        return  new SummaryInfo(code, name, photocard);
    }

    public void deleteSummaryInfo(){
        editor.remove("EMP_CODE").commit();
        editor.remove("EMP_NAME").commit();
        editor.remove("EMP_PHOTOCARD").commit();
    }
}
