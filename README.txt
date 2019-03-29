/*   										*/
/*   										*/
/*				This file is here to help 			*/
/*  			create the database and local server using		*/       
/*				Mongoose Express React Node 			*/
/*					(MERN)					*/
/*										*/
/*										*/



Back-End:

To run back-end, go to terminal/command prompt and move inside the directory:
ex. $ cd /Users/Piero/Desktop/survey-master

Once inside the folder, run:
$ npm i

This installs "node-modules" since GitHub does not accept this folder for it
being too large. Afterwards, run:
$ npm run server

This runs the server and should have a successful message in the command line as:
> Server running on port 5000
> MongoDB Connected

Right now the local server is 5000. To test a successful connection, go to the URL 
of the browser and type:
localhost:5000

Once you hit enter, it should display:
Hello World

The front-end is not connected yet, they are separate as of now.

To test whether or not the "users" database work, feel free to use Postman 
which could be installed through: 
https://www.getpostman.com

Open Postman, make it so it is "Get" and type on the URL:
http://localhost:5000/api/users/test

The output should be:
"Users Works"

NOTE: The server must be up and running, if it is closed it will not work.


Front-End:

All files of the front-end are in the "client" folder. 