Web Address folder:
https://titan.dcs.bbk.ac.uk/~rmorle01/w1tma/index.php


How to deploy the application:

To deploy the application, the database must be accessible, the SQL script is stored in the install folder.

Once the database is up and running, the index.php file should be able to run the web pages through
the views folder.

The index.php contains the links to each page. These are the home, artists, and songs.

Each web page in the views folder has its content. The home.php contains the message and the summary of the active artists and songs
from the database.

The artists.php contains the summary as well as the active artists and the number of songs associated with them.

The songs.php also contains the summary. It also has the active artists, the songs associated with them as well as the duration
of each song.

The 404.php contains the summary but it will only show up if the user finds a page that does not exist in this application.


The files and folders:

index.php
- this file contains all the core structure of the pages which also contains the links to each of them


Includes folder:
This folder contains the necessary files for:

openSQL.php
- opening the database

closeSQL.php
- closing the database

header.php
- automatically rename the title and the header two of the web page

config.php
- creates configuration to the database

summary.php
- the summary of the total number of active artists and songs


Install folder:
This folder contains the database file:

w1fma_tables.sql
- this is the SQL script which runs the tables of artist and song


Templates folder:
This folder contains the CSS and HTML files. These files are responsible for the appearance and structure of the web page

header.html
- this creates the opening tags of the HTML file

footer.html
- this creates the closing tags of the HTML file

CSS folder:
This folder contains the CSS file:

styles.css
- this creates the appearance of the website


Views folder:
This folder contains the web pages that are shown on the website

404.php
- this creates the error page if no pages exist on the website

artists.php
- this creates the artists' page that shows the number of active artists and the songs associated with them as well as the summary

songs.php
- this creates the songs page that shows the number of songs associated with the active artists and the duration of each song
this also contains the summary

home.php
- this contains the home page which will only show the message and the summary of the number of active artists and songs









