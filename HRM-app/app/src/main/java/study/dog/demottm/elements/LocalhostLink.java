package study.dog.demottm.elements;

/**
 * Created by Nguyen Nga on 20/06/2017.
 */

public class LocalhostLink {
   static final String LOCALHOST = "http://192.168.0.104:8080/";
    //static final String LOCALHOST = "http://192.168.0.107:8080/";
    String link;

    public LocalhostLink(String link) {
        this.link = link;
    }

    public String getLink() {
        return LOCALHOST + "" + link;
    }

    public void setLink(String link) {
        this.link = link;
    }
}
