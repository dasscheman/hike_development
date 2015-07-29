serverUrl='http://127.0.0.1:4444'
serverFile=selenium-server-standalone-2.44.0.jar
firefoxUrl=http://ftp.mozilla.org/pub/mozilla.org/firefox/releases/37.0.2/linux-x86_64/en-US/firefox-37.0.2.tar.bz2
firefoxFile=firefox.tar.bz2
phpVersion=`php -v`

sudo apt-get update

##echo "Updating Composer"
##sudo /home/travis/.phpenv/versions/5.3/bin/composer self-update

echo "Installing dependencies"
composer install

##composer global require 'phpunit/phpunit-selenium=*'
##composer global require 'phpunit/phpunit-story=*'
##composer global require 'phpunit/dbunit=*'
##composer global require 'phpunit/php-invoker=*'

##sudo mkdir -p /usr/share/php/PHPUnit
##sudo mkdir -p /usr/share/php/PHP

##cd /usr/local/bin/
##mkdir /tmp/phpunit
##sudo php -r '$phar = new Phar("phpunit.phar"); $phar->extractTo("/tmp/phpunit");'

##sudo cp -rp /tmp/phpunit/php-invoker/* /usr/share/php/PHP/
##sudo cp -rp /tmp/phpunit/dbunit/* /usr/share/php/PHPUnit/
##sudo cp -rp /tmp/phpunit/phpunit-selenium/* /usr/share/php/PHPUnit/
##sudo cp -rp /tmp/phpunit/phpunit-story/* /usr/share/php/PHPUnit/
##
##rm -rf /tmp/phpunit

##wget -O Yii.tar.gz https://github.com/yiisoft/yii/releases/download/1.1.16/yii-1.1.16.bca042.tar.gz
##tar -zxvf yii.tar.gz -C /home/travis/build/dasscheman/
##mv /home/travis/build/dasscheman/yii-1.1.16.bca042/ /home/travis/build/dasscheman/yii/

##mkdir PHPUnit
##mkdir PHPUnit/Extensions/
##wget -O PHPUnit/Extensions/SeleniumTestCase.php https://github.com/giorgiosironi/phpunit-selenium/blob/master/PHPUnit/Extensions/SeleniumTestCase.php

chmod 777 /home/travis/build/dasscheman/hike_development/hike_development/assets
chmod 777 /home/travis/build/dasscheman/hike_development/protected/runtime

echo "Download Firefox"
wget $firefoxUrl -O $firefoxFile
tar xvjf $firefoxFile

echo "Starting xvfb"
echo "Starting Selenium"
if [ ! -f $serverFile ]; then
    wget http://selenium-release.storage.googleapis.com/2.44/$serverFile
fi
if [ ! -e ${serverFile} ]; then
    echo "Cannot find Selenium Server!"
    echo "Test is aborted"
    exit
fi
sudo xvfb-run java -jar $serverFile > /tmp/selenium.log &
wget --retry-connrefused --tries=120 --waitretry=3 --output-file=/dev/null $serverUrl/wd/hub/status -O /dev/null
if [ ! $? -eq 0 ]; then
    echo "Selenium Server not started --> EXIT!"
    exit
else
    echo "Finished setup and selenium is started"
fi
