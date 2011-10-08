1 Users Features
================
* Users will have an account, they will authentify using user & pass(maybe using
popular web services as OpenID, Google or Facebook)
	* account recovery
    * account will need to be activated in 7 days from the creation
    * security question
* Users can have a profile
	* name, first name
	* birthday date
	* avatar (gravatar)
	* description
    * phone number
    * sex
    * timezone(UTC), location(country, city)
* Users will have a friends list

2 Category properties
=====================
* Name
* Description
* Color
* Repeat: daily/weekly/monthly/yearly/Off

Categories will be templates for the events and at the same time containers(for
grouping)

3 Events Features
=================
* Each event can belong to a category
* Each event will inherit the category's attributes
* Each event can have its attributes individually changed
* Find best meeting times, given two agendas
* Each event can be public or private
* If events will be showed on a calendar they will be represented by their color
* Each event can be set as an exception and it won't inherit category properties
on movement
* Each event, on movement from an category to another, can inherit the settings
  from the new category only if that event is not an exception

4 Event properties
==================
* Name
* Description
* Priority
* Color(inherited)
* Alarm:
    * On: set date/time to alert
    * Off: no alert available
* Repeat(inherited):
    * On: event will repeat together with the alarm 
    * Off:
        * Start/Due date (optional): when the event reaches its due date it's marked as done
            * if Due date is set then the alarm can be set only
            before this date

5 Setup
=======
* allow users to install Do To PHP using a wizard

6 Plugins Features
==================
* plugins can be either services or formats
* _services_ will interact with external programs
* _formats_ will import and convert foreign formats into ours

7 Administration Control Panel (ACP)
====================================
* users log
* posibility to ban/unban users
* delete users

*NOTE*: The priority of the features is from top to bottom. The highest
 priority is 1.
