#!/bin/bash 
set -e
source ~/.bash_profile
KEYSTORE=$1
cd $2
$3 clean
# copy file key in folder certs to android/app
cp "certs/$KEYSTORE" "android/app/$KEYSTORE"

# build app bundle
$3 build appbundle

# remove file key in android/app
rm "android/app/$KEYSTORE"

# move file app-release.aab to folder certs
# cp "$PATH_PROJECT/build/app/outputs/bundle/release/app-release.aab" "$PATH_PROJECT/certs/app-release.aab"