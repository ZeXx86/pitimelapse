#!/bin/bash

if pgrep timelapse.sh
then
    kill $(pgrep timelapse.sh) > /dev/null 2>&1
    echo "timelapse.sh stopped"
else
    echo "timelapse.sh not running"
fi

if pgrep raspistill
then
    kill $(pgrep raspistill) > /dev/null 2>&1
    echo "raspistill stopped"
else
    echo "raspistill not running"
fi
 
if pgrep mjpg_streamer
then
    kill $(pgrep mjpg_streamer) > /dev/null 2>&1
    echo "mjpg_streamer stopped"
else
    echo "mjpg_streamer not running"
fi
