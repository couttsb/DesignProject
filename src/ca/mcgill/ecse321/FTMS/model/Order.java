/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-edef018 modeling language!*/

package ca.mcgill.ecse321.FTMS.model;
import java.util.*;

// line 44 "../../../../../../../ump/161015272632/model.ump"
// line 88 "../../../../../../../ump/161015272632/model.ump"
public class Order
{

  //------------------------
  // STATIC VARIABLES
  //------------------------

  private static int nextId = 1;

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Autounique Attributes
  private int id;

  //Order Associations
  private List<MenuItem> menuItems;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Order()
  {
    id = nextId++;
    menuItems = new ArrayList<MenuItem>();
  }

  //------------------------
  // INTERFACE
  //------------------------

  public int getId()
  {
    return id;
  }

  public MenuItem getMenuItem(int index)
  {
    MenuItem aMenuItem = menuItems.get(index);
    return aMenuItem;
  }

  public List<MenuItem> getMenuItems()
  {
    List<MenuItem> newMenuItems = Collections.unmodifiableList(menuItems);
    return newMenuItems;
  }

  public int numberOfMenuItems()
  {
    int number = menuItems.size();
    return number;
  }

  public boolean hasMenuItems()
  {
    boolean has = menuItems.size() > 0;
    return has;
  }

  public int indexOfMenuItem(MenuItem aMenuItem)
  {
    int index = menuItems.indexOf(aMenuItem);
    return index;
  }

  public static int minimumNumberOfMenuItems()
  {
    return 0;
  }

  public boolean addMenuItem(MenuItem aMenuItem)
  {
    boolean wasAdded = false;
    if (menuItems.contains(aMenuItem)) { return false; }
    menuItems.add(aMenuItem);
    wasAdded = true;
    return wasAdded;
  }

  public boolean removeMenuItem(MenuItem aMenuItem)
  {
    boolean wasRemoved = false;
    if (menuItems.contains(aMenuItem))
    {
      menuItems.remove(aMenuItem);
      wasRemoved = true;
    }
    return wasRemoved;
  }

  public boolean addMenuItemAt(MenuItem aMenuItem, int index)
  {  
    boolean wasAdded = false;
    if(addMenuItem(aMenuItem))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfMenuItems()) { index = numberOfMenuItems() - 1; }
      menuItems.remove(aMenuItem);
      menuItems.add(index, aMenuItem);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveMenuItemAt(MenuItem aMenuItem, int index)
  {
    boolean wasAdded = false;
    if(menuItems.contains(aMenuItem))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfMenuItems()) { index = numberOfMenuItems() - 1; }
      menuItems.remove(aMenuItem);
      menuItems.add(index, aMenuItem);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addMenuItemAt(aMenuItem, index);
    }
    return wasAdded;
  }

  public void delete()
  {
    menuItems.clear();
  }


  public String toString()
  {
    String outputString = "";
    return super.toString() + "["+
            "id" + ":" + getId()+ "]"
     + outputString;
  }
}