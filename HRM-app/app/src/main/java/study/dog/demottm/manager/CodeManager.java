package study.dog.demottm.manager;

/**
 * Created by Nguyen Nga on 21/09/2017.
 */

public class CodeManager {

    public int invertCode(String code){
        String c = code.replace('E', '0');
        int getCode = Integer.parseInt(c);
        return getCode;
    }

    public String convertCode(int code){
        if(code< 10)
            return "E000" + code;
        else if (code<100){
            return "E00" +code;
        }else if (code <1000)
            return  "E0" +code;
        else
            return "E"+code;
    }
}
