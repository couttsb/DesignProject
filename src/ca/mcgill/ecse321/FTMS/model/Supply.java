/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-edef018 modeling language!*/

package ca.mcgill.ecse321.FTMS.model;

// line 42 "../../../../../../../../ump/161015272632/model.ump"
// line 79 "../../../../../../../../ump/161015272632/model.ump"
public class Supply
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Supply Attributes
  private String name;
  private int quantity;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Supply(String aName, int aQuantity)
  {
    name = aName;
    quantity = aQuantity;
  }

  //------------------------
  // INTERFACE
  //------------------------

  public boolean setName(String aName)
  {
    boolean wasSet = false;
    name = aName;
    wasSet = true;
    return wasSet;
  }

  public boolean setQuantity(int aQuantity)
  {
    boolean wasSet = false;
    quantity = aQuantity;
    wasSet = true;
    return wasSet;
  }

  public String getName()
  {
    return name;
  }

  public int getQuantity()
  {
    return quantity;
  }

  public void delete()
  {}


  public String toString()
  {
    String outputString = "";
    return super.toString() + "["+
            "name" + ":" + getName()+ "," +
            "quantity" + ":" + getQuantity()+ "]"
     + outputString;
  }
}