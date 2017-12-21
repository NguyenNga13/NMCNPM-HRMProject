package study.dog.demottm.entities;

/**
 * Created by Nguyen Nga on 21/09/2017.
 */

public class SummaryInfo {
    String code;
    String name;
    String photocard;

    public SummaryInfo(String code, String name, String photocard) {
        this.code = code;
        this.name = name;
        this.photocard = photocard;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPhotocard() {
        return photocard;
    }

    public void setPhotocard(String photocard) {
        this.photocard = photocard;
    }
}
