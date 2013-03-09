#!/bin/sh

rm -f ./p2/*
mkdir -p ./p2/
r=0;
cat letters4.txt  | while read line; do
		  #echo ${line} | cut -f ${c} -d " ";
		  c=1;
		  for LETTER in $(echo ${line} | cut -f ${c})
		  do

				 #echo ${LETTER};

					 pango-view  \
										  --text "${LETTER}" \
										  --font="KufiStandardGK 18" \
										  --background=transparent --rtl  -q \
										  -o ./p2/${r}.${c}.png; 
					 c=$(($c+1)) ;

					 #ls ./p2/${r}.png 2> /dev/null > /dev/null  && echo "${r}.png done"
		  done


r=$(($r+1)) 
done
