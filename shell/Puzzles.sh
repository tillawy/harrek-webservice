
rm -f ./Puzzles/*
mkdir  ./Puzzles
i=0;
ls -f -d1   ./PuzzlesClassified/intro/* ./PuzzlesClassified/easy/* ./PuzzlesClassified/medium/* ./PuzzlesClassified/hard/* | while read file; do

		  oldFileName=${file};
		  newFileName=$(printf "%03d" ${i}).txt;
		  echo "old:${oldFileName} -> new:${newFileName}";
		  echo cp ${oldFileName}  ./Puzzles/${newFileName};
		  cp ${oldFileName}  ./Puzzles/${newFileName};
		  ls ./Puzzles/${newFileName};
		  chmod 775 ./Puzzles/${newFileName};
		  i=$(( i + 1 ));

done

cp PuzzlesClassified/tutorials/tutorial0.txt ./Puzzles/ 
