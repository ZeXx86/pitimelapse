#!/bin/bash

cd $( dirname $0 )

source ./timelapse.conf
 
if [ ! -d $STREAM ]
then
	#echo "Error - directory $STREAM does not exist!"
	#exit -1
	mkdir $STREAM
fi

if [ ! -d $STORAGE ]
then
	#echo "Error - directory $STORAGE does not exist"
	#exit -1
	mkdir $STORAGE
fi

#echo "-= CONFIGURATION =-"
#echo "INTERVAL = $INTERVAL"
#echo "STREAM = $STREAM"
#echo "STORAGE = $STORAGE"
#echo "TIMETOLIVE = $TIMETOLIVE"
#echo

 
if pgrep raspistill > /dev/null
then
	echo "raspistill already running"
else
	raspistill -w $RESOLUTION_X -h $RESOLUTION_Y -q 5 -o $STREAM/pic.jpg -tl 100 -t 9999999 -th 0:0:0 -n > /dev/null 2>&1& 
	echo "raspistill started"
fi
 
if pgrep mjpg_streamer > /dev/null
then
	echo "mjpg_streamer already running"
else
	LD_LIBRARY_PATH=mjpg-streamer mjpg-streamer/mjpg_streamer -i "input_file.so -f $STREAM -n pic.jpg" -o "output_http.so -p 9000 -w mjpg-streamer/www" > /dev/null 2>&1&
	echo "mjpg_streamer started"
fi

if pgrep timelapse.sh > /dev/null
then
	echo "timelapse.sh already running"
else
	./timelapse.sh > /dev/null 2>&1&
	echo "timelapse.sh started"
fi
