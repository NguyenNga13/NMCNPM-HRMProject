package study.dog.demottm.entities;

/**
 * Created by Nguyen Nga on 15/12/2017.
 */

public class Allowance {
    private String id;
    private String allowance;
    private String allowanceCode;
    private String allowanceLevel;
    private String allowanceRate;
    private String allowanceValue;
    private String allowanceBegin;
    private String allowanceFinish;

    public Allowance(String id, String allowance, String allowanceCode, String allowanceLevel, String allowanceRate, String allowanceValue, String allowanceBegin, String allowanceFinish) {
        this.id = id;
        this.allowance = allowance;
        this.allowanceCode = allowanceCode;
        this.allowanceLevel = allowanceLevel;
        this.allowanceRate = allowanceRate;
        this.allowanceValue = allowanceValue;
        this.allowanceBegin = allowanceBegin;
        this.allowanceFinish = allowanceFinish;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getAllowance() {
        if(allowance.equals("null")){
            return null;
        }
        return allowance;
    }

    public void setAllowance(String allowance) {
        this.allowance = allowance;
    }

    public String getAllowanceCode() {
        if(allowanceCode.equals("null")){
            return null;
        }
        return allowanceCode;
    }

    public void setAllowanceCode(String allowanceCode) {
        this.allowanceCode = allowanceCode;
    }

    public String getAllowanceLevel() {
        if(allowanceLevel.equals("null")){
            return null;
        }
        return allowanceLevel;
    }

    public void setAllowanceLevel(String allowanceLevel) {
        this.allowanceLevel = allowanceLevel;
    }

    public String getAllowanceRate() {
        if(allowanceRate.equals("null")){
            return null;
        }
        return allowanceRate;
    }

    public void setAllowanceRate(String allowanceRate) {
        this.allowanceRate = allowanceRate;
    }

    public String getAllowanceValue() {
        if(allowanceValue.equals("null")){
            return null;
        }
        return allowanceValue;
    }

    public void setAllowanceValue(String allowanceValue) {
        this.allowanceValue = allowanceValue;
    }

    public String getAllowanceBegin() {
        if(allowanceBegin.equals("null")){
            return null;
        }
        return allowanceBegin;
    }

    public void setAllowanceBegin(String allowanceBegin) {
        this.allowanceBegin = allowanceBegin;
    }

    public String getAllowanceFinish() {
        if(allowanceFinish.equals("null")){
            return null;
        }
        return allowanceFinish;
    }

    public void setAllowanceFinish(String allowanceFinish) {
        this.allowanceFinish = allowanceFinish;
    }
}
