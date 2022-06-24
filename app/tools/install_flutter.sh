# #!/bin/bash
set +e

# ------------------------------------------------------------------------------
#  INSTALL JAVA SDK
echo "------------- Check JAVA SDK ---------------"
isIntallJavaSDK=0
result=$(javac -version 2>&1)
if [[ $result != *"javac"* ]]; then
    echo 'No Java SDK found on this machine, please click "OK" to turn off the installation suggestion popup, which is the latest version. It is not suitable for flutter. We need to install Java SDK 8, do you want to continue? (yes | no)'
    read resultChoose
    if [ $resultChoose != "yes" ]
    then 
        echo "Sorry, unable to continue installing flutter without Java SDK, please install Java SDK and try again.";
        exit 2;
    else
        echo "Check homebrew..."
        checkHomeBrew=$(brew -v)
        if [[ $checkHomeBrew != *"Homebrew"* ]]; then
            echo "Install HomeBrew..."
            echo "yes" | /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"
            brew -v
        fi
        brew tap homebrew/cask-versions
        brew cask install adoptopenjdk/openjdk/adoptopenjdk8
        echo "Check again Java SDK..."
        result=$(javac -version 2>&1)
        if [[ $result == *"javac"* ]]; then
            isIntallJavaSDK=1
        fi
    fi
else 
    isIntallJavaSDK=1
fi

if [ "$isIntallJavaSDK" == "0" ]
then 
    echo "Sorry, unable to continue installing flutter without Java SDK, please install Java SDK and try again."
    echo "------------- Check JAVA SDK ERROR! ---------------"
    exit -1
else 
    echo "Version java SDK is $result"
    echo "------------- Check JAVA SDK COMPLETE! ---------------"

fi


# ------------------------------------------------------------------------------
#  INSTALL ANDROID SDK
echo "------------- Check ANDROID SDK ---------------"
checkAndroidSdkTool=`sdkmanager --version`
if [ -z "$checkAndroidSdkTool" ]
then 
    echo "Not found android SDK tool. Start install android SDK tool..."
    if [ ! -d "$HOME/DevTool" ]
    then 
        cd $HOME
        mkdir -p "DevTool"
    fi
    cd $HOME
    mkdir -p .android && touch .android/repositories.cfg
    
    cd "$HOME/DevTool"
    mkdir -p Android/sdk

    # Set up Android SDK
    curl -O https://dl.google.com/android/repository/sdk-tools-linux-4333796.zip
    unzip sdk-tools-linux-4333796.zip && rm sdk-tools-linux-4333796.zip
    mv tools Android/sdk/tools
    echo 'export ANDROID_HOME='$HOME'/DevTool/Android/sdk' >> ~/.bash_profile
    echo 'export PATH=$PATH:$ANDROID_HOME/tools' >> ~/.bash_profile
    echo 'export PATH=$PATH:$ANDROID_HOME/tools/bin' >> ~/.bash_profile
    echo 'export PATH=$PATH:$ANDROID_HOME/platform-tools' >> ~/.bash_profile
    source ~/.bash_profile       
    yes | sdkmanager --licenses
    sdkmanager "build-tools;29.0.2" "patcher;v4" "platform-tools" "platforms;android-29" "sources;android-29"
    checkAndroidSdkTool=`sdkmanager --version`
fi

echo "Version Android SDK Tool $checkAndroidSdkTool"
echo "------------- Check ANDROID SDK COMPLETE---------------"

# ------------------------------------------------------------------------------
#  INSTALL FLUTTER
echo "------------- Check FLUTTER ---------------"
result=$(flutter --version)
if [ -z "$result" ] ; then
    echo "Not found flutter. Start install flutter ... "
    echo "Create folder DevTool in your folder home..."
    mkdir $HOME/DevTool
    cd $HOME/DevTool
    git clone https://github.com/flutter/flutter.git -b stable
    echo 'export PATH=$PATH:'$HOME'/DevTool/flutter/bin' >> ~/.bash_profile
    source ~/.bash_profile
    recheckFlutter=$(flutter --version)
    if [ -z "$recheckFlutter" ] ; then
        echo "Error! Please try again!"
        echo "------------- Check FLUTTER ERROR ---------------"
        exit -1
    fi
fi

echo "------------- Check FLUTTER COMPLETE ---------------"
echo "Please restart the terminal to complete the flutter installation !!!"
