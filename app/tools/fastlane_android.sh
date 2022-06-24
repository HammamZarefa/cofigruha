readonly playstore_services="/Users/manh/Downloads/api-8092026986449358220-198481-7f222f46f7d6.json"
readonly package_name="com.inspireui.fluxstore"
readonly appBundleFile="../build/app/outputs/bundle/release/app-release.aab"

#build app bundle
flutter clean
flutter build appbundle

#deploy to playstore
cd android
rm -rf fastlane
mkdir fastlane
echo "json_key_file(\"$playstore_services\")" >> fastlane/Appfile
echo "package_name(\"$package_name\")" >> fastlane/Appfile
echo "default_platform(:android)" >> fastlane/Fastfile
fastlane supply init
fastlane supply --aab $appBundleFile --skip_upload_images true --skip_upload_metadata true --skip_upload_changelogs true --skip_upload_screenshots true