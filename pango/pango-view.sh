#!/bin/sh

rm ./letters.png;
pango-view letters4.txt --font="KufiStandardGK 18" \
			--background=transparent --rtl  -q \
			-o ./letters.png
rm -f ./p/*
convert letters.png -crop 47x36  p/%d.png
ls letters.png 2> /dev/null > /dev/null  && echo "hi"
