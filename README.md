# Showcase on chromedriver character data processing glitch

This repository illustrates how data that is passed to 'sendKeys' gets interpreted by chromedriver (http://chromedriver.chromium.org) on Linux in an unexpected way:

* Intended input: 'hello'
* Resulting field value: 'llo'

Observation: 

Seems that characters 'e', 'r', 's' are translated as functional keys, where 'e' acts as backspace.

Tested with: 

* Google Chrome 67.0.3396.87
* ChromeDriver 2.40.565383 (76257d1ab79276b2d53ee976b2c3e3b9f335cde7)

More info: https://bugs.chromium.org/p/chromedriver/issues/detail?id=1771

## Pre-requisites

1. Use some Linux distro (issue not repeatable on MacOS, on validation done on Windows)
1. Have Composer installed (https://getcomposer.org)
1. Make sure you have the latest Chrome browser installed.

## Installation

1. `git clone git@github.com:vaimo/chromedriver-send-keys-issue.git` 
1. `cd chromedriver-send-keys-issue && composer install`
1. `. scripts/setup.sh` # installs Google Chrome if needed

## Running the tests

1. `composer test` # executes tests with headless chrome
1. (alternative) `composer test -- --use chrome-gui` # executes tests \w visible Chrome GUI  
