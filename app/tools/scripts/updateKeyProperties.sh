#!/bin/bash
echo "storePassword=$2" > $1
echo "keyPassword=$3" >> $1
echo "keyAlias=$4" >> $1
echo "storeFile=$5" >> $1