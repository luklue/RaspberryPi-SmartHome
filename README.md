#Raspberry Pi Smart Home Project

###Contents
* 1. Short Introduction
* 2. Used Hardware
* 3. Used Software
* 4. Installation of the distribution + controlling of the Raspi via ssh
* 5. Installation of additional software


###1. Short Introduction
In the summer of 2015 I did a practicum in a small company in Aachen, Germany. I started with literally zero knowledge
of programming and during three weeks I googled the shit together to complete this projekt. This is a step by step
ReadMe so you might want to skip some parts.

###2. Used Hardware
* Raspberry Pi B+ (In this project I just used 11 out of 40 Pins, so another Raspi might be possible)
* Some LEDs/Resistors/Cord for a testing environment
* Edimax Wlan stick

###3. Used Software
* Workspace distribution: Xubuntu 15.04 VM
    * Download here: http://xubuntu.org/getxubuntu/
* Raspberry Pi distribution: HypriotOS 0.4
    * Download here: http://blog.hypriot.com/downloads/
* Webserver: nginx
* Required Software:
    * Bootstrap
    * AngularJs
    * Angular
    * Slim Framework 2.3
    
    
###4. Installation of the distribution + controlling of the Raspi via ssh
To check how the installation and the controll via ssh works check this page:

http://blog.hypriot.com/getting-started-with-docker-and-linux-on-the-raspberry-pi/

Before you can controll the Raspi via ssh you need to configure the WLAN. Therefore check this guide [GERMAN]:

https://www.datenreise.de/raspberry-pi-wlan-einrichten-edimax/

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

###5. Installation of additional software
First of all we're going to do an update + upgrade and installing the nginx webserver, PHP and wiringPi.
````php
root@black-pearl ~ $ apt-get update
root@black-pearl ~ $ apt-get upgrade
root@black-pearl ~ $ apt-get install nginx php5-fpm git-core build-essential
root@black-pearl ~ $ git clone git://git.drogon.net/wiringPi
root@black-pearl ~ $ cd wiringPi
root@black-pearl in ~/wiringPi $ git pull origin
root@black-pearl in ~/wiringPi $ ./build
````
Now we're going to replace some files. First of all replace the nginx.conf under the located path.
````php
/etc/nginx/nginx.conf
````
After that add the file server.conf here:
````php
/etc/nginx/sites-available/server.conf
````
Now disable the default server and enable our new server:
````php
root@black-pearl ~ $ rm /etc/nginx/sites-enabled/default
root@black-pearl ~ $ ln -s /etc/nginx/sites-available/server.conf /etc/nginx/sites-enabled/server
root@black-pearl ~ $ service nginx start
````
