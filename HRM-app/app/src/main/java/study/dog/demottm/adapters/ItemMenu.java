package study.dog.demottm.adapters;

/**
 * Created by Nguyen Nga on 21/04/2017.
 */

public class ItemMenu {
    String name;
    Integer icon;

    public ItemMenu(Integer icon, String name) {
        this.icon = icon;
        this.name = name;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Integer getIcon() {
        return icon;
    }

    public void setIcon(Integer icon) {
        this.icon = icon;
    }
}
