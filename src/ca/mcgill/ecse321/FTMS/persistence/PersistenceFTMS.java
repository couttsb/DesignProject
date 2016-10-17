package ca.mcgill.ecse321.FTMS.persistence;

import java.util.Iterator;

import ca.mcgill.ecse321.FTMS.model.Equipment;
import ca.mcgill.ecse321.FTMS.model.FTMSManager;
import ca.mcgill.ecse321.FTMS.model.Menu;
import ca.mcgill.ecse321.FTMS.model.MenuItem;
import ca.mcgill.ecse321.FTMS.model.Schedule;

public class PersistenceFTMS {

	private static void initializeXStream() {
		PersistenceXStream.setFilename("ftms.xml");
		PersistenceXStream.setAlias("equipment", Equipment.class);
		PersistenceXStream.setAlias("menu", Menu.class);
		PersistenceXStream.setAlias("menuitem", MenuItem.class);
		PersistenceXStream.setAlias("schedulemanager", Schedule.class);
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
			Iterator<Model1> xIt = ftms2.getModel1s().iterator();
			while (pIt.hasNext())
				rm.addParticipant(pIt.next());
			Iterator<Model2> yIt = ftms2.getEvents().iterator();
			while (eIt.hasNext())
				rm.addEvent(eIt.next());
			Iterator<Model3> zIt = ftms2.getRegistrations().iterator();
			while (rIt.hasNext())
				rm.addRegistration(rIt.next());
		}
	}
}
