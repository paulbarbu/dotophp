1 Users Features
===============================
* Users will have an account, they will authentify using user & pass
* Users can have a profile
	* can set name
	* can set birthday
	* can set avatar (gavatar)
	* can set a short description
* Users will have a friends list
* Users can put their phone number that will be available to all of his friends    

2 Category properties
===============================
* Name
* Description
* Alarm: On/Off
* Repeat: daily/weekly/monthly/yearly/Off

3 Events Features
===============================
* Each event can belong to a category
* Each event will inherit the category's attributes
* Each event can have its attributes individually changed
* Find best meeting times, given two agendas
* Each event can be public, shared with a friend or private
* Each event can be set as an exception
* Each event, on movement from an category to another, can inherit the settings from the new category only if that event is not an exception

4 Event properties
===============================
* Name
* Description
* Priority
* Alarm(inherited, changeable): 
    * if On: set date/time to alert
    * if Off: no alert available
* Repeat(inherited, changeable):
    * if On: event will repeat together with the alarm 
    * if Off: when the event reaches its due date it's marked as done
* Start/due date (optional)

5 Plugins Features
===============================
* plugin system

6 ACP
===============================

*NOTE*: The priority of the features is from top to bottom. The highest priority is 1 and the lowest is 6. 
