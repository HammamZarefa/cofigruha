#!/bin/bash 
PATH_PROJECT=$(pwd)
KEYSTORE="key.jks"

# copy file key in folder certs to android/app
cp "./certs/$KEYSTORE" "$PATH_PROJECT/android/app/$KEYSTORE"

# build app bundle
flutter build appbundle

# remove file key in android/app
rm "$PATH_PROJECT/android/app/$KEYSTORE"

# move file app-release.aab to folder certs
# cp "$PATH_PROJECT/build/app/outputs/bundle/release/app-release.aab" "$PATH_PROJECT/certs/app-release.aab"