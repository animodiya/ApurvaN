*****Database*********
There is 1 database consisting of two tables

1)The first table is storing to to Do and its description.
  Here to Do and description together make the primary key.

2) The second is the already done tasks table which also contains already done tasks and its description.
	
Note: The SQL dump files are present in the folder if you want to have a look at the structure of the database.


****Application Functionality*********

The Todo Application which manages all the tasks for you has following basic features::

>>"Add a toDo button" adds a task to your toDo list.
 -This button click inserts the new task row in the first table i.e."Todo".

>>"Mark as all done button" transfers all the task from your toDo list to done list.
- All the current to Do's in Todo table will be transferred to the "Already_done" table.

>>"Show all done Tasks button" displays all the tasks which have been finished by the user (i.e.have been marked as done).

>>"Done" button respective to every Pending toDo's gives user the option to mark that particular task as done.
  -Post this button click, the respective task is deleted from toDo list and added to Done list.

>>"Delete" button respective to every Completed or done task is used to delete the task permanently from the system.


****Technologies used******

1) MAMP Server
2) MySQL
3) PHP
4) Javascript/Ajax/Jquery
  -- Also we had to use JavaScript/AJAX/jQuery because these technologies are to be used when we handle the client side.
PHP handles the server side communication.

Note: All the implemented files are in the folder.




