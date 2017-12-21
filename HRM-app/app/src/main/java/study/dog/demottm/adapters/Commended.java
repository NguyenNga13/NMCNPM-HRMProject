package study.dog.demottm.adapters;

/**
 * Created by Nguyen Nga on 19/06/2017.
 */

public class Commended {
    private String date, num, form, reason, document;
    private boolean type;
    private float value;

    public Commended(String date, boolean type, String form, String reason, String num, String document, float value) {
        this.date = date;
        this.type = type;
        this.form = form;
        this.reason = reason;
        this.num = num;
        this.document = document;
        this.value = value;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public boolean isType() {
        return type;
    }

    public void setType(boolean type) {
        this.type = type;
    }

    public String getNum() {
        return num;
    }

    public void setNum(String num) {
        this.num = num;
    }

    public String getReason() {
        return reason;
    }

    public void setReason(String reason) {
        this.reason = reason;
    }

    public String getForm() {
        return form;
    }

    public void setForm(String form) {
        this.form = form;
    }

    public String getDocument() {
        return document;
    }

    public void setDocument(String document) {
        this.document = document;
    }

    public float getValue() {
        return value;
    }

    public void setValue(float value) {
        this.value = value;
    }
}
