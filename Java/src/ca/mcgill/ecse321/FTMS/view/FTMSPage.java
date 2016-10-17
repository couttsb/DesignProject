package ca.mcgill.ecse321.FTMS.view;

import java.awt.Color;
import java.awt.List;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.util.ArrayList;
import java.util.Iterator;

import javax.swing.GroupLayout;
import javax.swing.GroupLayout.Alignment;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;

import ca.mcgill.ecse321.FTMS.controller.OrderController;
import ca.mcgill.ecse321.FTMS.model.FTMSManager;
import ca.mcgill.ecse321.FTMS.model.MenuItem;

public class FTMSPage {

	public JFrame frame;


	private String error;
	private ArrayList<MenuItem> menuItems;


	// UI elements
	private JLabel errorLabel;
	private JButton orderButton;

	private List menuList;

	/**
	 * Create the application.
	 */
	public FTMSPage() {
		initialize();
		refreshData();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frame = new JFrame();
		frame.getContentPane().setBackground(Color.WHITE);
		frame.setBounds(100, 100, 450, 300);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

		JLabel lblMenu = new JLabel("Menu:");

		errorLabel = new JLabel("Error: Asjdlksajdksaljdsalk");
		errorLabel.setForeground(Color.RED);

		menuList = new List();
		
		menuList.addItemListener(new ItemListener() {
			@Override
			public void itemStateChanged(ItemEvent e) {
				String item = ((List)e.getSource()).getSelectedItem();
				orderButton.setText("Order " + item);
				orderButton.setEnabled(true);
			}
			
		});

		//		Checkbox checkbox = new Checkbox("Burger");
		//		checkbox.setBounds(0, 0, 108, 24);

		menuList.add("Burger");

		orderButton = new JButton("Order");
		orderButton.setEnabled(false);
		orderButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				orderButtonActionPerformed(e);
			}
		});
		GroupLayout groupLayout = new GroupLayout(frame.getContentPane());
		groupLayout.setHorizontalGroup(
				groupLayout.createParallelGroup(Alignment.LEADING)
				.addGroup(groupLayout.createSequentialGroup()
						.addGroup(groupLayout.createParallelGroup(Alignment.LEADING)
								.addGroup(groupLayout.createSequentialGroup()
										.addContainerGap()
										.addGroup(groupLayout.createParallelGroup(Alignment.LEADING)
												.addComponent(errorLabel, GroupLayout.DEFAULT_SIZE, 408, Short.MAX_VALUE)
												.addComponent(lblMenu)))
								.addGroup(groupLayout.createSequentialGroup()
										.addGap(22)
										.addGroup(groupLayout.createParallelGroup(Alignment.LEADING)
												.addComponent(orderButton)
												.addComponent(menuList, GroupLayout.PREFERRED_SIZE, 172, GroupLayout.PREFERRED_SIZE))))
						.addContainerGap())
				);
		groupLayout.setVerticalGroup(
				groupLayout.createParallelGroup(Alignment.LEADING)
				.addGroup(groupLayout.createSequentialGroup()
						.addContainerGap()
						.addComponent(errorLabel)
						.addGap(4)
						.addComponent(lblMenu)
						.addGap(13)
						.addComponent(menuList, GroupLayout.PREFERRED_SIZE, 125, GroupLayout.PREFERRED_SIZE)
						.addGap(28)
						.addComponent(orderButton)
						.addContainerGap())
				);
		frame.getContentPane().setLayout(groupLayout);
	}

	private void refreshData() {
		FTMSManager ftms = FTMSManager.getInstance();
		//	System.out.println(ftms.getMenu().getMenuItems().size());

		// error
		errorLabel.setText(error);
		if (error == null || error.length() == 0) {
			// participant list
			menuItems = new ArrayList<MenuItem>();
			menuList.removeAll();
			Iterator<MenuItem> mIt = ftms.getMenu().getMenuItems().iterator();

			while(mIt.hasNext()) {
				MenuItem m = mIt.next();
				menuItems.add(m);
				menuList.add(m.getName());
			}
		}

		frame.pack();
	}

	private void orderButtonActionPerformed(ActionEvent evt) {
		// call the controller
		try {
			OrderController.placeOrder(getSelectedMenuItems());
		} catch (Exception e) {
			error = e.getMessage();
		}
		
		orderButton.setText("Order");
		orderButton.setEnabled(false);

		// update visuals
		refreshData();
	}

	// Slow, bad algorithm from converting selected items (strings) into menu items found on the menu
	private ArrayList<MenuItem> getSelectedMenuItems() {
		ArrayList<MenuItem> items = new ArrayList<MenuItem>();

		for (String item : menuList.getSelectedItems()) {
			items.add(OrderController.FromStringToMenuItem(item));
		}

		return items;
	}
}
