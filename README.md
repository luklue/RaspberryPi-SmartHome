#Raspberry Pi Smart Home Projekt

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
Type into the shell: 
````php
Luk7q@Xubuntu ~ $ dd bs=1M if=[IMG] of=[DEVICE]"
````
Replace [IMG] with the path to the distribution and [DEVICE] with the path to your SD-Card.
For the first installation you should connect your Raspi with a keyboard and a monitor.
After you finished copying your distribution you can put the SD-Card in the Raspi and connect it with the power cable.

Your username is "root" and your password is "hypriot"
[Beware that it is now an American keyboard layout!]
Type into the shell 
````php
root@black-pearl ~ $ hostname -I
````
and write down the IP-adress. Now we can disconnect the keyboard and monitor from
the Raspi and we continue our work from a normal computer with a ssh connection to the Raspi.
To connect your PC with the Raspi just type into the shell: 
````php
Luk7q@Xubuntu ~ $ ssh root@[IP]
````

Lets have some fun at this step. To see if everything works fine you can connect a LED (+ resistor) with gpio 17. To
see a list of the gpios and Pins look here: http:
````php
root@black-pearl ~ $ echo "17" > /sys/class/gpio/export
root@black-pearl ~ $ echo "out" > /sys/class/gpio/gpio17/direction
#To turn the LED on just copy and paste the command below. To turn it off replace "1" with "0"
root@black-pearl ~ $ echo "1" > /sys/class/gpio/gpio17/value
````
Now we can turn the LED on/off.

###5. Installation of additional software
First of all we're going to do an update + upgrade and installing the nginx webserver.
````php
root@black-pearl ~ $ apt-get update
root@black-pearl ~ $ apt-get upgrade
root@black-pearl ~ $ apt-get install nginx php5-fpm
````

