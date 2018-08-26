=====================
=NIGHTCRAWLER README=
=====================
------------------------------------------
-SETUP INSTRUCTIONS AND PROJCT STRUCTURE:-
------------------------------------------
- Turn on both Apache and MySQL servers via XAMPP. Put "nightcrawler" in the htdocs folder of XAMPP.
- You should now be able to access the website by opening a browser and going to "localhost/nightcrawler"
- You need to import the database (found in nightcrawler.sql) first using XAMPP's phpmyadmin. The database
MUST be called "nightcrawler" (without the quotation marks).

- The folders "MVF1", "MVF2", "MVF4" all contain previous versions of the MVFs designed by different
members of the team before the whole site was put together.
- The folders "google Map Search" and "Practice Map" contain test runs of the Google Maps API. They 
have not been integrated into the main site yet. You may need an API key from Google to run the maps
API correctly.

The login system is based on the one found in this PHP tutorial, especially the validation testing:
https://www.youtube.com/watch?v=xb8aad4MRx8 
(44: How to create a complete login system in PHP (READ DESC) | PHP tutorial | Learn PHP programming)
The search algorithm is also based on this tutorial:
https://www.youtube.com/watch?v=lwgG_uIJYQM
(57: How to create a search field with PHP and MySQLi | PHP tutorial | Learn PHP programming)

A lot of other material, especially things like CSS, were made following tutorials on w3schools.com
(https://www.w3schools.com/css/css_website_layout.asp)

---------
-ISSUES:-
---------
- There is currently no connection between the map page and the route or business page.
	- There are a number of reasons for this - it was too difficult to test the geolocation of the user.
	- The use of the Google Maps API required API keys, which not all team members were able to get
	- There were time problems, what with all the report writing we were doing as well as coding
	- It should be relatively straightforward to include the map, including directions, now that most
	of the MVFs have been completed
- There are currently no images on the website
	- It would have been prohibitive for us to get permission from all the businesses we used.
	In order to test the map, we used real businesses for the addresses, so using photos and
	promotional material may have infringed on copyrights. All the reviews are fake.
- There is a list of the pretend user accounts and their login details found at:
	https://trello.com/c/wTm8udQC