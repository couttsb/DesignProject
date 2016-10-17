package ca.mcgill.ecse321.FTMS.persistence;

import java.util.Iterator;

import ca.mcgill.ecse321.FTMS.model.Equipment;
import ca.mcgill.ecse321.FTMS.model.FTMSManager;
import ca.mcgill.ecse321.FTMS.model.Menu;
import ca.mcgill.ecse321.FTMS.model.MenuItem;
import ca.mcgill.ecse321.FTMS.model.Staff;
import ca.mcgill.ecse321.FTMS.model.Supply;

public class PersistenceFTMS {

	private static void initializeXStream() {
		PersistenceXStream.setFilename("ftms.xml");
		PersistenceXStream.setAlias("FTMSManager", FTMSManager.class);
		PersistenceXStream.setAlias("Equipment", Equipment.class);
		PersistenceXStream.setAlias("Menu", Menu.class);
		PersistenceXStream.setAlias("Staff", Staff.class);
		PersistenceXStream.setAlias("Supply", Supply.class);
		PersistenceXStream.setAlias("MenuItem", MenuItem.class);
	}
	
	/**
	 * This function should be called before running FTMS software or else previous
	 * actions will not be persisted into subsequent runs.
	 */
	public static void loadFTMSModel() {
		FTMSManager ftms = FTMSManager.getInstance();
		initializeXStream();
		
		FTMSManager ftms2 = (FTMSManager) PersistenceXStream.loadFromXMLwithXStream();
		
		if (ftms2 != null) {
			// unfortunately, this creates a second RegistrationManager object, even though it is a singleton
			// copy loaded model into singleton instance of RegistrationManager, because this will be used throughout the application
			ftms.setMenu(ftms2.getMenu());
						
			Iterator<Equipment> eIt = ftms2.getEquipment().iterator();
			while (eIt.hasNext())
				ftms.addEquipment(eIt.next());
			
			Iterator<Staff> sIt = ftms2.getStaff().iterator();
			while (sIt.hasNext())
				ftms.addStaff(sIt.next());
			
			Iterator<Supply> supIt = ftms2.getSupplies().iterator();
			while (supIt.hasNext())
				ftms.addSupply(supIt.next());
		}
	}
}
