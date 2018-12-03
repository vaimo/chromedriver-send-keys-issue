# Showcase on chromedriver character data processing glitch

This repository illustrates how data that is passed to 'sendKeys' gets interpreted by chromedriver (http://chromedriver.chromium.org) on Linux in an unexpected way:

* Intended input: 'hello'
* Resulting field value: 'llo'

Observation: 

Seems that characters 'e', 'r', 's' are translated as functional keys, where 'e' acts as backspace.

Tested/repeated with: 

* Google Chrome 
  * 69.0.3497.100
  * 70.0.3538.110
* ChromeDriver: 
  * 2.42 for Linux 64Bits (acfcc29fb03df9e913ef4c360a121ad1)
  * 2.44.609551 for Linux 64Bits (5d576e9a44fe4c5b6a07e568f1ebc753f1214634)
  
More info: https://bugs.chromium.org/p/chromedriver/issues/detail?id=1771

## Pre-requisites

1. Use some Linux distro (issue not repeatable on MacOS, on validation done on Windows)
1. Have Composer installed (https://getcomposer.org)
1. Make sure you have the latest Chrome browser installed.
1. (updating Chrome) `sudo apt-get update && sudo apt-get --only-upgrade install google-chrome-stable`

## Installation

1. `git clone git@github.com:vaimo/chromedriver-send-keys-issue.git`
1. `cd chromedriver-send-keys-issue && composer install`
1. `. scripts/setup.sh` # installs Google Chrome if needed

## Running the tests

1. `composer test` # executes tests with headless chrome
1. (alternative) `composer test -- --use chrome-gui` # executes tests \w visible Chrome GUI

## Fixing the issue

The issue can not be encountered if user make sure that proper keymap is configured for the system keyboard:

```shell
setxkbmap en_US
```

This makes the test that is bundled with this repository and that illustrates the issue to pass with flying colors.
