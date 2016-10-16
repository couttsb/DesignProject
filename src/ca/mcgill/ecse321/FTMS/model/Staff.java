/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-edef018 modeling language!*/

package ca.mcgill.ecse321.FTMS.model;
import java.util.*;

// line 16 "../../../../../../../../ump/161015272632/model.ump"
// line 67 "../../../../../../../../ump/161015272632/model.ump"
public class Staff
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Staff Attributes
  private Role role;
  private List<Boolean> availability;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Staff(Role aRole)
  {
    role = aRole;
    availability = new ArrayList<Boolean>();
  }

  //------------------------
  // INTERFACE
  //------------------------

  public boolean setRole(Role aRole)
  {
    boolean wasSet = false;
    role = aRole;
    wasSet = true;
    return wasSet;
  }

  public boolean addAvailability(Boolean aAvailability)
  {
    boolean wasAdded = false;
    wasAdded = availability.add(aAvailability);
    return wasAdded;
  }

  public boolean removeAvailability(Boolean aAvailability)
  {
    boolean wasRemoved = false;
    wasRemoved = availability.remove(aAvailability);
    return wasRemoved;
  }

  public Role getRole()
  {
    return role;
  }

  public Boolean getAvailability(int index)
  {
    Boolean aAvailability = availability.get(index);
    return aAvailability;
  }

  public Boolean[] getAvailability()
  {
    Boolean[] newAvailability = availability.toArray(new Boolean[availability.size()]);
    return newAvailability;
  }

  public int numberOfAvailability()
  {
    int number = availability.size();
    return number;
  }

  public boolean hasAvailability()
  {
    boolean has = availability.size() > 0;
    return has;
  }

  public int indexOfAvailability(Boolean aAvailability)
  {
    int index = availability.indexOf(aAvailability);
    return index;
  }

  public boolean isAvailability()
  {
    return availability;
  }

  public void delete()
  {}


  public String toString()
  {
    String outputString = "";
    return super.toString() + "["+ "]" + System.getProperties().getProperty("line.separator") +
            "  " + "role" + "=" + (getRole() != null ? !getRole().equals(this)  ? getRole().toString().replaceAll("  ","    ") : "this" : "null")
     + outputString;
  }
}