#!/bin/bash

if [ -f "$1" ]
 then 
   echo $1 
   exit 0
fi
exit -1

