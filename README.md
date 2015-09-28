#Raspberry Pi Smart Home Project

###List of Contents
* 1. Short Introduction
* 2. Used Hardware
* 3. Installation of the distribution + controlling of the Raspi via ssh
* 4. Installation of additional software
* 5. Copying files

###1. Short Introduction
In the summer of 2015 I did a internship in a small company in Aachen, Germany. I started with literally zero knowledge of programming and during three weeks I googled the shit together to complete this project. This is a step by step ReadMe so you might want to skip some parts.

###2. Used Hardware
* Raspberry Pi B+ (In this project I just used 11 out of 40 Pins, so another Raspi might be possible)
* Some LEDs/Resistors/Cord for a testing environment
* Edimax Wlan stick

###3. Installation of the distribution + controlling of the Raspi via ssh
To check how the installation and the controll via ssh works check this page:

http://blog.hypriot.com/getting-started-with-docker-and-linux-on-the-raspberry-pi/

Before you can controll the Raspi via ssh you need to configure the WLAN. Therefore check this guide [GERMAN]:

https://www.datenreise.de/raspberry-pi-wlan-einrichten-edimax/

Remember to expand the filesystem so we can use the full size of the SD card. Check this answer as tutorial:

http://raspberrypi.stackexchange.com/questions/499/how-can-i-resize-my-root-partition

Lets have some fun at this step. To see if everything works fine you can connect a LED (+ resistor) with gpio 17. To
see a list of the gpios and Pins look here:

http://www.element14.com/community/servlet/JiveServlet/previewBody/73950-102-4-309126/GPIO_Pi2.png
````php
root@black-pearl ~ $ echo "17" > /sys/class/gpio/export
root@black-pearl ~ $ echo "out" > /sys/class/gpio/gpio17/direction
#To turn the LED on just copy and paste the command below. To turn it off replace "1" with "0"
root@black-pearl ~ $ echo "1" > /sys/class/gpio/gpio17/value
````
Now we can turn the LED on/off.

###4. Installation of additional software
First of all we're going to do an update + upgrade and installing the nginx webserver, PHP and wiringPi.
````php
root@black-pearl ~ $ apt-get update
root@black-pearl ~ $ apt-get upgrade
root@black-pearl ~ $ apt-get install nginx php5-fpm php5-cli git-core build-essential
root@black-pearl ~ $ git clone git://git.drogon.net/wiringPi
root@black-pearl ~ $ cd wiringPi
root@black-pearl in ~/wiringPi $ git pull origin
root@black-pearl in ~/wiringPi $ ./build
````
Now we're going to replace some files. First of all replace the nginx.conf and the server.conf

You can find these files in the folder /etc

Now disable the default server and enable our new server:
````php
root@black-pearl ~ $ rm /etc/nginx/sites-enabled/default
root@black-pearl ~ $ ln -s /etc/nginx/sites-available/server.conf /etc/nginx/sites-enabled/server
root@black-pearl ~ $ service nginx start
````

###5. Copying files
Download and unzip the following files and place them in /var/www
* https://codeload.github.com/IronSummitMedia/startbootstrap-4-col-portfolio/zip/v1.0.3 and rename it to "bootstrap".
* https://codeload.github.com/angularjs-de/angularjs-tutorial-code/zip/gh-pages and rename it to "angularjs".
* https://code.angularjs.org/1.4.3/angular-1.4.3.zip 

To install Slim Framework we're going to use the command line again.
````php
cd /var/www
curl -sS https://getcomposer.org/installer | php
php composer.phar require slim/slim
````

We are going to write a small script that we have to execute after every restart of the Raspi. This script defines all the GPIOs. To create this script type:
````php
nano /root/start.sh
````
And add this to the file:
````php
cd /sys/class/gpio
echo "4" > export
echo "14" > export
echo "17" > export
echo "18" > export
echo "22" > export
echo "23" > export
echo "10" > export
echo "25" > export
echo "11" > export
echo "8" > export
echo "out" > gpio4/direction
echo "in" > gpio14/direction
echo "out" > gpio17/direction
echo "in" > gpio18/direction
echo "out" > gpio22/direction
echo "in" > gpio23/direction
echo "out" > gpio10/direction
echo "in" > gpio25/direction
echo "out" > gpio11/direction
echo "in" > gpio8/direction
cd
echo "done"
````
To execute this file simple type this command (remember that you have to do this after every restart):
````php
sh ./start.sh
````
In the last step we just have to copy and paste the listed files here at GitHub to /var/www

You successfully did the setup of your new SmartHome with a Raspberry Pi. The possibilities are endless, have fun! 
