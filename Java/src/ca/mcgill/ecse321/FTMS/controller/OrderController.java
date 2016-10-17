package ca.mcgill.ecse321.FTMS.controller;

import java.util.List;

import ca.mcgill.ecse321.FTMS.model.FTMSManager;
import ca.mcgill.ecse321.FTMS.model.Menu;
import ca.mcgill.ecse321.FTMS.model.MenuItem;
import ca.mcgill.ecse321.FTMS.model.Supply;
import ca.mcgill.ecse321.FTMS.persistence.PersistenceXStream;

public class OrderController {

	public static MenuItem FromStringToMenuItem(String item) {
		FTMSManager ftms = FTMSManager.getInstance();
		Menu menu = ftms.getMenu();

		for (MenuItem mItem : menu.getMenuItems()) {
			if (mItem.getName().equals(item)) {
				return mItem;
			}
		}

		return null;
	}

	public static void placeOrder(List<MenuItem> order) throws Exception {
		FTMSManager ftms = FTMSManager.getInstance();

		if (order.size() == 0) {
			throw new Exception("Cannot make an empty order!");
		}

		// Check if each menu item on the order can be made
		for(MenuItem item : order) {
			if (item == null) {
				throw new Exception("One of your ordered items is no longer on the menu.");
			}
			if(!canItemBeMade(item)) {
				throw new Exception(item.getName() +" cannot be made as a result of missing ingredients.");
			}

			// Remove ingredients used from supply, and increase popularity of each item ordered
			for(Supply s : item.getIngredients()){
				// Find supply which matches the ingredient and remove it from the database
				for (Supply ftmsSupply : ftms.getSupplies()) {
					if (s.getName().equals(ftmsSupply.getName())) {
						ftmsSupply.setQuantity(ftmsSupply.getQuantity() - s.getQuantity());
						System.out.println("Lowered supply of " + s.getName());
					}
				}
			}
			increasePopularity(ftms, item);
		}

		System.out.println("Order completed.");

		// Save changes to XML stream
		PersistenceXStream.saveToXMLwithXStream(ftms);
	}

	private static void increasePopularity(FTMSManager ftms, MenuItem item) {
		for (MenuItem ftmsItem : ftms.getMenu().getMenuItems()) {
			if (item.getName().equals(ftmsItem.getName())) {
				ftmsItem.setPopularity(ftmsItem.getPopularity()+1);
				System.out.println("Increased popularity of " + item.getName());
				return;
			}
		}
	}

	// todo inefficient to use this method, adapt it into the loop
	private static boolean canItemBeMade(MenuItem item) {
		// if no ingredients are specified, assume it requires no ingredients to make
		if (item.getIngredients().size() == 0) return true;
		
		FTMSManager ftms = FTMSManager.getInstance();
		boolean ingredientFound = false;
		
		for(Supply ingredient : item.getIngredients()){
			for (Supply supply : ftms.getSupplies()) {
				if(supply.getName().equals(ingredient.getName())) {
					ingredientFound = true;
					if (supply.getQuantity() - ingredient.getQuantity() < 0) {
						return false;
					}
				}
			}
		}
		
		return ingredientFound;
	}
}
