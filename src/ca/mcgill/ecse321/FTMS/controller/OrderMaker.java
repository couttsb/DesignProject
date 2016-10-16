package ca.mcgill.ecse321.FTMS.controller;

import java.util.List;

import ca.mcgill.ecse321.FTMS.model.MenuItem;
import ca.mcgill.ecse321.FTMS.model.Supply;

public class OrderMaker {
	
	public static void placeOrder(List<MenuItem> order) throws Exception {
		
		// Check if each menu item on the order can be made
		for(MenuItem item : order){
			if(!canItemBeMade(item)){
				throw new Exception(item.getName() +" cannot be made as a result of missing ingredients.");
			}
		}

		// Remove ingredients used from supply, and increase popularity of each item ordered
		for(MenuItem item : order){
			for(Supply s : item.getSupplies()){
				s.setQuantity(s.getQuantity() - 1);
			}
			item.setPopularity(item.getPopularity()+1);
		}
		
		// TODO save to XML stream
	}

	public static boolean canItemBeMade(MenuItem item){
		for(Supply s : item.getSupplies()){
			if(s.getQuantity() <= 0)
				return false;
		}
		return true;
	}
}
