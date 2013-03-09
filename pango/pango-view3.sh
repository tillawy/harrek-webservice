#!/bin/sh

rm -f ./p2/*
mkdir -p ./p2/
r=0;

NUMOFLETTERS=$(cat letters3.xml | grep '</Letter>'| wc -l);
a=5;
for (( l=1; l<=${NUMOFLETTERS}; l++ )); do
		  letterXML=$(xmllint --encode utf8 --xpath "/Letters/Letter[position() = ${l}] " letters3.xml)
		  echo ${letterXML}
		  t=$(echo ${letterXML} | xmllint --xpath "//Last/text()" -)
		  echo $t;

		  pango-view  --text "${t}" \
										  --font="KufiStandardGK 18" \
										  --background=transparent --rtl  -q \
										  -o ./p2/${l}.Last.png; 
		  c=$(($c+1)) ;
done



exit 0;
cat letters4.txt  | while read line; do
		  #echo ${line} | cut -f ${c} -d " ";
		  c=1;
		  for LETTER in $(echo ${line} | cut -f ${c})
		  do

				 #echo ${LETTER};


					 #ls ./p2/${r}.png 2> /dev/null > /dev/null  && echo "${r}.png done"
		  done


r=$(($r+1)) 
done
