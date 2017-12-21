package study.dog.demottm.entities;

/**
 * Created by Nguyen Nga on 24/09/2017.
 */

public class Language {
    String language, certificate, level, dateOfIssued, expired, issuedBy;

    public String getLanguage() {
        return language;
    }

    public void setLanguage(String language) {
        this.language = language;
    }

    public String getIssuedBy() {
        return issuedBy;
    }

    public void setIssuedBy(String issuedBy) {
        this.issuedBy = issuedBy;
    }

    public String getCertificate() {
        return certificate;
    }

    public void setCertificate(String certificate) {
        this.certificate = certificate;
    }

    public String getLevel() {
        return level;
    }

    public void setLevel(String level) {
        this.level = level;
    }

    public String getDateOfIssued() {
        return dateOfIssued;
    }

    public void setDateOfIssued(String dateOfIssued) {
        this.dateOfIssued = dateOfIssued;
    }

    public String getExpired() {
        return expired;
    }

    public void setExpired(String expired) {
        this.expired = expired;
    }
}
