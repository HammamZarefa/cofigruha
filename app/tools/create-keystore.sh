#!/bin/sh
set -e

WORKING_DIR=$(pwd)
file="$WORKING_DIR/tools/configs/create-keystore.conf"

usage() {
    if [ "$*" != "" ] ; then
        echo "Error: $*"
    fi

    cat << EOF

Usage: 
 - Step 1: 
    Add data to 3 keys in file create-keystore.conf, this is the installation file to run create-keystore.sh. 
        NAME_FILE : name of file key store
        NAME_ALIAS : name if Alias
        PASSWORD : password of keyPassword and storePassword
- Step 2:
    Run script with command: 
        bash create-keystore.sh
- Step 3: Enter info of key

Note: In the final step, a few cases will ask:
        Enter key password for <mstoreapp>
        (RETURN if same as keystore password):
Press "Enter" to finish.

EOF

    exit 1
}

name_file=""
name_alias=""
passwordKey=""


while IFS="=" read -r key value; do
    case "$key" in
        "NAME_FILE") name_file="$value" ;;
        "NAME_ALIAS") name_alias="$value" ;;
        "PASSWORD") passwordKey="$value" ;;
    esac
done < "$file"
echo $passwordKey
if [ -z "$name_file" ] ; then
    usage "The value of the NAME_FILE variable cannot be found in the file create-keystore.conf"
    
fi

if [ -z "$name_alias" ] ; then
    usage "The value of the NAME_ALIAS variable cannot be found in the file create-keystore.conf"
fi

if [ -z "$passwordKey" ] ; then
    usage "The value of the PASSWORD variable cannot be found in the file create-keystore.conf"
fi

keytool -genkey -v -keystore "$WORKING_DIR/android/app/$name_file.keystore" -keyalg RSA -keysize 2048 -validity 10000 -alias "$name_alias" -storepass "$passwordKey"

echo -e "storePassword=$passwordKey\nkeyPassword=$passwordKey\nkeyAlias=$name_alias\nstoreFile=$name_file.keystore" > "$WORKING_DIR/android/$name_file-key.properties"
echo "PATH KEY STORE:           $WORKING_DIR/android/app/$name_file.keystore"
echo "PATH PROPERTIES KEY:      $WORKING_DIR/android/$name_file-key.properties"
echo "Please edit file          $WORKING_DIR/android/app/build.gradle for use variable of key store"
