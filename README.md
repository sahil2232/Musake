# Musake
Downloads all the songs of the movie typed(Bollywood Only)

Its a PHP Based simple HTML DOM Parser Used to parse a website(www.songspk.link). 
It works perfectly fine on OSX (using XAMPP)

SETUP INSTRUCTIONS:
1. git clone the directory https://github.com/sahil2232/Musake.git
2. Copy "Musake" Folder to htdocs folder of XAMPP.
3. Give full read-write permissions to the folder using the command:
      chmod -R Musake
4. Start XAMPP Server and open the URL  http://localhost/Musake
5. First Update the Movie list by clicking on the update button. It will create a mapping of the movie name with the 
  movie link in a json(data.json).
6. Type in the movie name in the text box and click on search and download movie button.
  It will download all the songs of that movie on the folder Musake Music/{movie name}.

NOTE : Even if you type an incorrect name, it will correct it for you by computing the minimum Edit Distance
between the typed name and all the movie names in the json file.
