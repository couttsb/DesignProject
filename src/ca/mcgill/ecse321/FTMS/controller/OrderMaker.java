package ca.mcgill.ecse321.FTMS.controller;

import java.util.List;

import ca.mcgill.ecse321.FTMS.model.Menu;
import ca.mcgill.ecse321.FTMS.model.MenuItem;
import ca.mcgill.ecse321.FTMS.model.Order;
import ca.mcgill.ecse321.FTMS.model.Supply;

public class OrderMaker {
	public static Order placeOrder(List<MenuItem> order) throws Exception{
	Order o = new Order();
		for(MenuItem item : order){
			if(!canItemBeMade(item)){
				throw new Exception("Item "+ item.getName() +" cannot be made");
			} else{
				o.addMenuItem(item);
			}
		}
		return o;
	}
	
	public static List<MenuItem> whatWasOrdered(Order order){
		return order.getMenuItems();
	}
	
	public static boolean canItemBeMade(MenuItem item){
		for(Supply s : item.getSupplies()){
			if(s.getQuantity() <= 0)
				return false;
		}
		return true;
	}
	
	public static List<MenuItem> getMenuItems(){
		return Menu.getInstance().getItem();
	}

	//Incomplete
	public static void fufillOrder(Order order){
		for(MenuItem i : order.getMenuItems()){
			for(Supply s : i.getSupplies()){
				//Decrease supply
			}
			i.setPopularity(i.getPopularity()+1);
		}
	}
	
	public static int getPopularityOfItem(MenuItem item){
		return item.getPopularity();
	}
}
