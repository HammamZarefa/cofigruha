#fastlane 2.168.0
readonly github="https://github.com/vumanhsn97/fastlane" #Make sure you login in your git account. Try to test with: git clone your_url
readonly app_identifier="com.inspireui.mstore.flutter"
readonly signal_identifier="com.inspireui.mstore.flutter.onesignal"
readonly email="vumanhsn97@gmail.com" #Your apple account
readonly version="1.9.2"
readonly build="3003"

flutter clean
flutter build ios --release --no-codesign
cd ios
rm -rf fastlane
fastlane run update_app_identifier app_identifier:"$app_identifier" plist_path:"Runner/Info.plist"
fastlane run increment_version_number version_number:"$version"
fastlane run increment_build_number build_number:"$build"
fastlane init #Update to TestFlight use option 2
# fastlane init <<EOF
# 2
# $email
# \n
# \n
# \n
# EOF
# fastlane match init <<EOF
# 1
# https://github.com/vumanhsn97/fastlane
# EOF
while IFS= read -r line                     
do
  if [[ "$line" == *"lane :beta do"* ]]
  then
    echo "$line" >> fastlane/Fastfile2
    echo "    sync_code_signing(type: \"appstore\", app_identifier: [\"$app_identifier\", \"$signal_identifier\"])" >> fastlane/Fastfile2
  else
    if [[ "$line" == *"increment_build_number"* ]]
    then
      echo "    increment_build_number(xcodeproj: \"Runner.xcodeproj\", build_number: $build)" >> fastlane/Fastfile2
    else
      echo "$line" >> fastlane/Fastfile2
    fi
  fi
done < fastlane/Fastfile
cp -f fastlane/Fastfile2 fastlane/Fastfile
rm -rf fastlane/Fastfile2
echo "git_url(\"$github\")" >> fastlane/Matchfile
echo "storage_mode(\"git\")" >> fastlane/Matchfile
echo "type(\"appstore\")" >> fastlane/Matchfile
echo "app_identifier([\"$app_identifier\", \"$signal_identifier\"])" >> fastlane/Matchfile
echo "username(\"$email\")" >> fastlane/Matchfile
fastlane match
fastlane run update_project_team
fastlane beta