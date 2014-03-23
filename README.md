PITIMELAPSE
-----------

Installation:

1. Download file DEB package from our git repository and open terminal
2. Try to install package: sudo dpkg -i ./pitimelapse_0.1.0-1_armhf.deb
3. Resolve dependencies: sudo apt-get -f install
4. Finally install package sudo dpkg -i ./pitimelapse_0.1.0-1_armhf.deb
5. sudo lighty-enable-mod fastcgi-php
6. usermod -a -G www-data pi
7. usermod -a -G video www-data
8. service lighttpd force-reload

Usage:

1. Open web browser with URL http://raspberypi
2. Go to Configuration and click the Start button