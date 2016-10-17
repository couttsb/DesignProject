package ca.mcgill.ecse321.FTMS.application;

import java.awt.EventQueue;

import ca.mcgill.ecse321.FTMS.persistence.PersistenceFTMS;
import ca.mcgill.ecse321.FTMS.view.FTMSPage;

public class FTMSApplication {

	public static void main(String[] args) {
		// load model
		PersistenceFTMS.loadFTMSModel();
		
		// start UI
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					FTMSPage window = new FTMSPage();
					window.frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}
}
