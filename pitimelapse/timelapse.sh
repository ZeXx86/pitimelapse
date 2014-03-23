#!/bin/bash

cd $( dirname $0 )

source ./timelapse.conf

while true
do
	sleep $INTERVAL

	datetime=`date +%Y-%m-%d-%H-%M-%S`

	filename="img-$datetime.jpg"
 
	text="`date` $IMGDESC"
	# zkopirovani snimku ze streamu
	convert -font helvetica -fill yellow -pointsize 36 -draw "text 30,50 '$text'" $STREAM/pic.jpg $STORAGE/$filename

	# vymaz snimku starsich, nez TTL
	find $STORAGE/*.jpg -mmin +$TIMETOLIVE -delete > /dev/null 2>&1

done
