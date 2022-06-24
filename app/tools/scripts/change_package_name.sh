#!/bin/bash 
set -e
source ~/.bash_profile
renamepackage(){
    DIR=""
    if [ "$*" != "" ] ; then
        DIR="$*"
    fi
    ORIG_DIR=$DIR
    cd $DIR
    
    IFS='.' read -ra packages <<< "$new_android_packagename"
    for i in "${packages[@]}"; do
        DIR="$DIR/$i"
        mkdir $i
        cd $i
    done
    cd $ROOT_DIR
    echo $DIR
}
getNameFolderDir(){
    PACKAGE_NAME=""
    if [ "$*" != "" ] ; then
        PACKAGE_NAME="$*"
    fi
    DIR=""

    IFS='.' read -ra packages <<< "$PACKAGE_NAME"
    for i in "${packages[@]}"; do
        DIR="$DIR/$i"
    done

    echo $DIR
}

# ---------------START:  change package name -----------------------
old_android_packagename=$1
new_android_packagename=$2
OLD_ANDROID_PACKAGE_NAME_ESCAPED="${old_android_packagename//./\.}"
NEW_ANDROID_PACKAGE_NAME_ESCAPED="${new_android_packagename//./\.}"
LC_ALL=C find "android/app" -type f \( -iname \*.gradle -o -iname \*.xml -o -iname \*.json -o -iname \*.java -o -iname \*.kt \) -exec sed -i "" "s/$OLD_ANDROID_PACKAGE_NAME_ESCAPED/$NEW_ANDROID_PACKAGE_NAME_ESCAPED/g" {} +


# ---------------END:  move file MainActivity.java-----------------------

# ---------------START:  move file MainActivity.java-----------------------
# # Rename project folder structure
DIR_MAIN="android/app/src/main/java"
OLD_DIR_JAKO="$DIR_MAIN$( getNameFolderDir $old_android_packagename)"
FILE_NAME_ANDROID="MainActivity.java"

if [ ! -f "$DIR_MAIN/$FILE_NAME_ANDROID" ]; then
    DIR_MAIN="android/app/src/main/kotlin"
    OLD_DIR_JAKO="$DIR_MAIN$( getNameFolderDir $old_android_packagename)"
    FILE_NAME_ANDROID="MainActivity.kt"
fi
NEW_DIR_MAIN=$( renamepackage $DIR_MAIN )
# rename application file

mv $OLD_DIR_JAKO/$FILE_NAME_ANDROID $NEW_DIR_MAIN/$FILE_NAME_ANDROID
exit 0
# ---------------END:  move file MainActivity.java-----------------------