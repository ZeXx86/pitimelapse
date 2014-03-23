#!/bin/bash

cd $( dirname $0 )

STATUS=0

if ! pgrep raspistill > /dev/null
then
	STATUS=-1
fi
 
if ! pgrep mjpg_streamer > /dev/null
then
	STATUS=-1
fi

if ! pgrep timelapse.sh > /dev/null
then
	STATUS=-1
fi

exit $STATUS