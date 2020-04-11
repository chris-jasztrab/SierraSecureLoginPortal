# SierraSecureLoginPortal
A small PHP script that uses the Sierra API to hide resources behind a library card number and PIN.

The script is a small PHP webpage that asks the user to enter in a Library Card # and PIN. It then uses the Sierra API to query the ILS to see if the patron exists and if the PIN is valid. It does not leak any information about the patron to the interface, in that if either the barcode or PIN are incorrect it just responds with a message for the patron to check their barcode and PIN.

My goal when creating this scrips was to make it so i can use the same login portal and have the ability to redirect to many different resources based on what the user was seeking. To accomplish this the resource is passed along with the URL. There is only one resource in the script today which is Ancestry. 

The resource is called like this:  http://yourwebsiteurl.ca/securelogin/index.php?resource=Ancestry

This will present the patron with a login window, and upon successful authentication, redirect them to Ancestry. You will need to contact Proquest Support and let them know what URL the request will be coming from, they use the refferer URL to determine the library making the request. 

It is entirely up to you, but i suggest that the code in the html folder be placed at the root of your site, and the private folder one below.  This prevents people from accessing your config.php file.
