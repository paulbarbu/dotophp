Features of the DoToPHP Project
===============================



Users Features
=============================== 
* users will have an account, they will authentify using user & pass
* each user can use an avatar (gravatar)

Events Features
===============================
* each event will belong to a category
* each category can have different settings(attributes)
* each event will inherit the category's attributes
* each event can have its attributes individually changed

Category properties
===================
* Name
* Description
* Alarm: On/Off
* Repeat: daily/weekly/monthly/yearly/Off

Event properties
================
* Name
* Description
* Due date
* Priority(low, medium, high, top)
* Alarm(inherited, changeable): 
    * if On: set date/time to alert
    * if Off: no alert available
* Repeat(inherited, changeable):
    * if On: event will repeat together with the alarm 
    * if Off: when the event reaches its due date it's marked as done
