package ca.mcgill.ecse321.FTMS.controller;

import java.util.List;

import ca.mcgill.ecse321.FTMS.model.FTMSManager;
import ca.mcgill.ecse321.FTMS.model.MenuItem;
import ca.mcgill.ecse321.FTMS.model.Supply;
import ca.mcgill.ecse321.FTMS.persistence.PersistenceXStream;

public class OrderMaker {
	
	public static MenuItem FromStringToMenuItem(String item) {
		
	}
	
	public static void placeOrder(List<MenuItem> order) throws Exception {
		
		// Check if each menu item on the order can be made
		for(MenuItem item : order) {
			if(!canItemBeMade(item)){
				throw new Exception(item.getName() +" cannot be made as a result of missing ingredients.");
			}
		}
		
		FTMSManager ftms = FTMSManager.getInstance();

		// Remove ingredients used from supply, and increase popularity of each item ordered
		for(MenuItem item : order){
			for(Supply s : item.getIngredients()){
			//	s.setQuantity(s.getQuantity() - 1);
				ftms.getSupply(0);
			}
			item.setPopularity(item.getPopularity()+1);
		}
		
		// TODO save to XML stream
		PersistenceXStream.saveToXMLwithXStream(order);
	}

	public static boolean canItemBeMade(MenuItem item){
		for(Supply s : item.getIngredients()){
			if(s.getQuantity() <= 0)
				return false;
		}
		return true;
	}
}
