package ca.mcgill.ecse321.FTMS.controller;

import java.sql.Date;
import java.util.List;

import ca.mcgill.ecse321.FTMS.model.ScheduleManager;
import ca.mcgill.ecse321.FTMS.model.Staff;
import ca.mcgill.ecse321.FTMS.model.Schedule;

//We return the schedule for that week (whether it be blank or full)
//If it's blank we leave that to the user to fill in

public class ScheduleMaker {
	public static List<Staff> whosOnShift(Schedule s){
		return s.getStaffs();
		//We should get a method of determining who's working what day
	}
	
	//Finds the current week, moves forward/backwards n weeks
	public static Schedule goForwardNWeeks(Schedule s, int weeksForward){
		ScheduleManager sm = ScheduleManager.getInstance();
		List<Schedule> scheds = sm.getSchedules();
		for(int i=0; i<scheds.size(); i++){
			if(scheds.get(i).equals(s)){
				try{
					Schedule newSched = scheds.get(i+weeksForward);
					return newSched;
				}catch(Exception e){//If it doesn't exist, make it
					Date d = new Date(s.getSunday().getTime()+weeksToLong(weeksForward));
					return makeSchedule(d);
				}
			}
		}
		return null;
	}
	public static long weeksToLong(int weeks){
		return 1000*60*60*24*7*weeks;
	}
	
	//Now we've made it. You fill it in
	public static Schedule makeSchedule(Date sunday){
		ScheduleManager sm = ScheduleManager.getInstance();
		if(getSchedule(sunday) != null){ //If it already exists, don't make a new one
			return getSchedule(sunday);
		}
		Schedule s = new Schedule(sunday);
		sm.addSchedule(s);
		return s;
	}
	
	public static Schedule getSchedule(Date sunday){
		List<Schedule> schedules = ScheduleManager.getInstance().getSchedules();
		//Search for the date that aligns with today.
		for(Schedule s : schedules){
			if(s.getSunday().getTime() == sunday.getTime()){
				return s;
			}
		}
		
		return null; //No record found
	}

	public static void addEmployeeToSchedule(Staff person, Schedule schedule){
		schedule.addStaff(person);
		//We need some way to organize who works when
	}
}
