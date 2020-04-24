COSC 3380 Library Database - Group 15

Group Members:
Muhammad Abbas
David Seijas
Khoa Tran
Karla Lemus
J. G. Hernandez

Summary of User Roles
Student user: The average person who has registered to be a part of the library and can search, check out, and return items 
that are part of the library. Will be issued a static fine if they turn in a book past the due date. Student users are only
allowed to check out an item for 3 days and are only allowed to check out up to 3 items at a time.

Faculty user: Similar to student user, however, a faculty user is allowed to check out an item for 5 days and 
are also allowed to check out up to 5 items at a time.

Administrator: An employee of the library who has access to add or delete items in the library. They are 
able to see all of the users who are registered to be part of the library and have access to the reports 
to see an overall view of the library. Admin's can also see what has been reserved, and what has been checked out 
and returned.


Student users:

	Username: user1
	Password: user1
	
	Username: user3
	Password: user3
	
	Username: user5
	Password: user5


Faculty user

	Username: user2
	Password: user2
	
	Username: user4
	Password: user4


Administrator

	Username: admin1
	Password: admin1


Steps to Make a New Item
1. Sign in as an admin using the "Admin portal" button
2. Enter admin1 as the username and password
3. Click on "Titles" on the left of the screen
4. Click the "Add Item" button
5. Fill in the book information
6. Click "Submit"
7. New item is now added to the database

Steps to Delete an Item
1. Sign in as an admin using the "Admin portal" button
2. Enter admin1 as the username and password
3. Click on "Titles" on the left of the screen
4. Click the "Delete" button next to a title 
you wish to delete
5. Click "Yes"
6. Item is now deleted and it is updated in the database

Steps to Edit an Item
1. Sign in as an admin using the "Admin portal" button
2. Enter admin1 as the username and password
3. Click on "Titles" on the left of the screen
4. Click the "Edit" button next to a title
5. Fill in the new information
6. Item reflects the new changes 

How to Find Reports
1. Log in as an admin using the "Admin Portal" button
2. Enter admin1 as the username and password
3. Click on "Reports" on the left side of the screen
4. Click on a report you would like to view

Steps to Check Out an Item
1. Log in as a regular user using the "Log In" button
2. Enter user1 as the username and password
3. Click on the "Search" button in the top right of the screen
4. Search for a book or item
5. Click "Search"
6. Click on "Check Out" of any item
7. Click "Yes" to check out a book
8. If you go back to your dashboard, your item will show as well as when it is due

Steps to Edit a User Profile
1. Log in as a regular user using the "Log In" button
2. Enter user1 as the username and password
3. Click "User Profile" on the left hand side of the screen
4. Click "Edit"
5. Change the info
6. Enter user1 as the password twice
7. User Profile has now been changed


Triggers:
1. The first trigger comes after making a new fee in the "fees" table. 
It updates the total "fees" in the "cardholder" table after creating a new 
"fee" in the "fees" table.
2. After a new "item" is made in the "item" table, if it is a new item 
with a new isbn number, then it inserts it as a new item in the "inventory" 
table. If it is not a new item, then it inserts it into the "inventory" table, 
but updates "totalCopies" in "item" table by 1 and updates "totalAvailable" 
in the "item" table by 1.

Disclaimer:
The Event Scheduler status can not be turned on in the website database due to the lack of Super Privileges
that are not granted to users. We tried to gain access to Super Privileges but the service did not offer it.
To test the Event that creates the fees, please download the repository and set up the project on your local
server. Please note that you will need to change the username and password to match your systems information.
You can change those by going to \application\config\database.php. 
You will also need to change it accordingly in line #3 of the following 3 files:

\application\views\adminfuncs\fetchCheckout.php

\application\views\adminfuncs\fetchFee.php

\application\views\adminfuncs\fetchReservation.php


