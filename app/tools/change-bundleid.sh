#!/bin/sh
set -e

ROOT_DIR=$(pwd)
file="$ROOT_DIR/tools/configs/change-bundleid.conf"

# old_android_packagename=""
new_android_packagename=""
old_android_packagename=""

new_ios_packagename=""
old_ios_packagename=""

# old_title=""
new_folder_name=""
old_folder_name=$(basename "$PWD")

# old_name=""
new_name_project=""
old_name_project=""

new_name_app=""
old_name_app=""

die() {
    echo "$PROGNAME: $*" >&3
    exit 1
}

usage() {
    if [ "$*" != "" ] ; then
        echo "Error: $*"
    fi

    cat << EOF

Usage: bash script-change-bundleid.sh bash script-change-bundleid.sh 
    --folder-name [FOLDER_NAME] 
    --old-android-package-name [OLD_PACKAGE_NAME_ANDROID] --android-package-name [NEW_PACKAGE_NAME_ANDROID]
    --old-ios-package-name [OLD_PACKAGE_NAME_IOS] --ios-package-name [NEW_PACKAGE_NAME_IOS]
    --old-name-project [OLD_NAME_PROJECT] --name-project [NEW_NAME_PROJECT]
    --old-name-app [OLD_NAME_APP] --name-app [NEW_NAME_APP]

Rename an Android & IOS app and package.
Options:
-h,     --help                                                      display this usage message and exit

-ap,    --android-package-name        [NEW_PACKAGE_NAME_ANDROID]    new package name (i.e. com.example.package)
-oap,   --old-android-package-name    [OLD_PACKAGE_NAME_ANDROID]    old package name (i.e. com.example.package)

-ip,    --ios-package-name            [NEW_PACKAGE_NAME_IOS]        new package name (i.e. com.example.package)
-oip,   --old-ios-package-name        [OLD_PACKAGE_NAME_IOS]        old package name (i.e. com.example.package)

-f,     --folder-name                 [NEW_FOLDER_NAME]             new Folder Name (i.e. MyApp)

-np,     --name-project               [NEW_NAME_PROJECT]            new name in pubspec.yaml
-onp,    --old-name-project           [OLD_NAME_PROJECT]            old name in pubspec.yaml

-na,     --name-app                   [NEW_NAME_APP]                new name app
-ona,    --old-name-app               [OLD_NAME_APP]                old name app

EOF

    exit 1
}


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

while IFS="=" read -r key value; do
    case "$key" in
        "NEW_ANDROID_PACKAGE_NAME") new_android_packagename="$value" ;;
        "OLD_ANDROID_PACKAGE_NAME") old_android_packagename="$value" ;;
        "NEW_IOS_PACKAGE_NAME")     new_ios_packagename="$value" ;;
        "OLD_IOS_PACKAGE_NAME")     old_ios_packagename="$value" ;;
        "NEW_FOLDER_NAME")          new_folder_name="$value" ;;
        "NEW_NAME_PROJECT")         new_name_project="$value" ;;
        "OLD_NAME_PROJECT")         old_name_project="$value" ;;
        "NEW_NAME_APP")             new_name_app="$value" ;;
        "OLD_NAME_APP")             old_name_app="$value" ;;
    esac
done < "$file"

# ---------------START:  check arguments -----------------------
# while [ $# -gt 0 ] ; do
#     case "$1" in
#     -h|--help)
#         usage
#         ;;
#     -ap|--android-package-name)
#         new_android_packagename="$2"
#         shift
#         ;;
#     -oap|--old-android-package-name)
#         old_android_packagename="$2"
#         shift
#         ;;
#     -ip|--ios-package-name)
#         new_ios_packagename="$2"
#         shift
#         ;;
#     -oip|--old-ios-package-name)
#         old_ios_packagename="$2"
#         shift
#         ;;
#     -f|--folder-name)
#         new_folder_name="$2"
#         shift
#         ;;
#     # -of|--old-folder-name)
#     #     old_folder_name="$2"
#     #     shift
#     #     ;;
#     -np|--name-project)
#         new_name_project="$2"
#         shift
#         ;;
#     -onp|--old-name-project)
#         old_name_project="$2"
#         shift
#         ;;
#     -na|--name-app)
#         new_name_app="$2"
#         shift
#         ;;
#     -ona|--old-name-app)
#         old_name_app="$2"
#         shift
#         ;;
#     -*)
#         usage "Unknown option '$1'"
#         ;;
#     *)
#         usage "Too many arguments"
#       ;;
#     esac
#     shift
# done

#  1.Check name folder
# if [ -n "$old_folder_name" ] ; then 
#     usage "Not enough -of,--old-folder-name"
# fi


#  2.Check package name android
if [ -n "$new_android_packagename" ] ; then 
    if [ -z "$old_android_packagename" ] ; then
        usage "Not enough -oap,--old-android-package-name"
    fi
fi

if [ -n "$old_android_packagename" ] ; then 
    if [ -z "$new_android_packagename" ] ; then
        usage "Not enough -ap,--android-package-name"
    fi
fi


#  3.Check package name ios
if [ -n "$old_ios_packagename" ] ; then 
    if [ -z "$new_ios_packagename" ] ; then
        usage "Not enough -ip,--ios-package-name"
    fi
fi

if [ -n "$new_ios_packagename" ] ; then 
    if [ -z "$old_ios_packagename" ] ; then
        usage "Not enough -oip,--old-ios-package-name"
    fi
fi

#  4.Check name app
if [ -n "$new_name_app" ] ; then 
    if [ -z "$old_name_app" ] ; then
        usage "Not enough -ona,--old-name-app"
    fi
fi

if [ -n "$old_name_app" ] ; then 
    if [ -z "$new_name_app" ] ; then
        usage "Not enough -na,--name-app"
    fi
fi

#  5.Check name project
if [ -n "$new_name_project" ] ; then 
    if [ -z "$old_name_project" ] ; then
        usage "Not enough -onp,--old-name-project"
    fi
fi

if [ -n "$old_name_project" ] ; then 
    if [ -z "$new_name_project" ] ; then
        usage "Not enough -np,--name-project"
    fi
fi

cd $ROOT_DIR

# --------------- END:  check arguments -----------------------

# ------------------------------------------------------------------
# 1.--------------- START:  change folder name -----------------------
if [ -n "$new_folder_name" ] ; then
    cd ..
    NEW_FOLDER_NAME_NO_SPACES="${new_folder_name// /}"

    # get rid of the git history
    # rm -rf ./.git

    # backup source 
    mkdir "${NEW_FOLDER_NAME_NO_SPACES}_old"
    cp -a "$old_folder_name" "${NEW_FOLDER_NAME_NO_SPACES}_old"

    # # Rename main folder
    mv $old_folder_name $NEW_FOLDER_NAME_NO_SPACES
else
    NEW_FOLDER_NAME_NO_SPACES=$old_folder_name 
fi
# --------------- END: change folder name -----------------------


# 2.---------------------- START : change package name ANDROID ----------------------
if [ -n "$new_android_packagename" ]
then 
    # ---------------START:  change package name -----------------------
    OLD_ANDROID_PACKAGE_NAME_ESCAPED="${old_android_packagename//./\.}"
    NEW_ANDROID_PACKAGE_NAME_ESCAPED="${new_android_packagename//./\.}"
    LC_ALL=C find "$ROOT_DIR/android/app" -type f \( -iname \*.gradle -o -iname \*.xml -o -iname \*.json -o -iname \*.java -o -iname \*.kt \) -exec sed -i "" "s/$OLD_ANDROID_PACKAGE_NAME_ESCAPED/$NEW_ANDROID_PACKAGE_NAME_ESCAPED/g" {} +

  
    # ---------------END:  move file MainActivity.java-----------------------
    
    # ---------------START:  move file MainActivity.java-----------------------
    # # Rename project folder structure
    DIR_MAIN="android/app/src/main/java"
    OLD_DIR_JAKO="$DIR_MAIN$( getNameFolderDir $old_android_packagename)"
    FILE_NAME_ANDROID="MainActivity.java"

    if [ ! -f "$ROOT_DIR/$DIR_MAIN/$FILE_NAME_ANDROID" ]; then
        DIR_MAIN="android/app/src/main/kotlin"
        OLD_DIR_JAKO="$DIR_MAIN$( getNameFolderDir $old_android_packagename)"
        FILE_NAME_ANDROID="MainActivity.kt"
    fi
    NEW_DIR_MAIN=$( renamepackage $DIR_MAIN )
    # rename application file

    mv $ROOT_DIR/$OLD_DIR_JAKO/$FILE_NAME_ANDROID $ROOT_DIR/$NEW_DIR_MAIN/$FILE_NAME_ANDROID
    # ---------------END:  move file MainActivity.java-----------------------
fi
# ---------------------- END : change package name ANDROID ----------------------


# 3.---------------------- START : change package name IOS ----------------------
if [ -n "$new_ios_packagename" ]
then
    # change appbundule in IOS
    cd $ROOT_DIR
    LC_ALL=C find "$ROOT_DIR" -type f \( -iname \*.pbxproj -o -iname \*.plist \) -exec sed -i "" "s/$old_ios_packagename/$new_ios_packagename/g" {} +
fi

# ---------------------- END : change package name IOS ----------------------


# 4.---------- START : change name app (name in pubspec.yaml) ----------
if [ -n "$new_name_project" ]
then
    #Change name app
    cd $ROOT_DIR
    # LC_ALL=C find "$ROOT_DIR" -type f \( -iname \*.yaml \) -exec sed -i "" "s/$old_name_project/$new_name_project/g" {} +
    old_name_project="$old_name_project\/"
    new_name_project="$new_name_project\/"
    LC_ALL=C find "$ROOT_DIR" -type f \( -iname \*.dart \) -exec sed -i "" "s/$old_name_project/$new_name_project/g" {} +
fi

# ------------ END : change name app (name in pubspec.yaml) ----------
