#./bin/sh
t=0
while [ "$t" -lt  1000 ]
 do
   mv $t.jpg $t.jpeg
   t=`expr $t + 1`
   done
