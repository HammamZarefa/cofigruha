#!/bin/bash
set -e
flutter clean
rm -rf macos/Pods
rm -rf ios/Pods
rm -f macos/Podfile.lock
rm -f ios/Podfile.lock
rm -f pubspec.lock
echo "Clean done !!!"