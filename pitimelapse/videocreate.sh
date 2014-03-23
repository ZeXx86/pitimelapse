#!/bin/bash

cd $( dirname $0 )

source ./timelapse.conf


# spojeni jednotlivych fotek do videa
#convert $STORAGE/*.jpg -delay 10 -morph 10 $STORAGE/%05d.jpg

cd $STORAGE && \
rm -f output.avi
cat $@ | avconv -f image2pipe -r $FPS -vcodec mjpeg -i - output.avi

