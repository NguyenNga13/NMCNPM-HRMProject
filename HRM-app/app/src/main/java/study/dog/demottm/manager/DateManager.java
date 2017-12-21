package study.dog.demottm.manager;

import java.util.Calendar;

/**
 * Created by Nguyen Nga on 20/09/2017.
 */

public class DateManager {
    Calendar currentTime;

    public DateManager() {
        currentTime = Calendar.getInstance();
    }

    public int getYear() {
        return currentTime.get(Calendar.YEAR);
    }
    public int getMonth() {
        return currentTime.get(Calendar.MONTH);
    }
    public int getDay() {
        return currentTime.get(Calendar.DAY_OF_MONTH);
    }

    public int getCurrentDay(){
        int year = currentTime.get(Calendar.YEAR);
        int month = currentTime.get(Calendar.MONTH);
        int day = currentTime.get(Calendar.DAY_OF_MONTH);
        int currentDay = year*10000 + month*100 + day;
        return currentDay;
    }

    public int getAfterDay(int d){
        currentTime.add(Calendar.DAY_OF_YEAR, d);
        int year = currentTime.get(Calendar.YEAR);
        int month = currentTime.get(Calendar.MONTH);
        int day = currentTime.get(Calendar.DAY_OF_MONTH);
        int afterDay = year*10000 + month*100 + day;
        return afterDay;
    }
}
