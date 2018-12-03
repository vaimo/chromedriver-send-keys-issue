# Showcase on chromedriver character data processing glitch

This repository illustrates how data that is passed to 'sendKeys' gets interpreted by chromedriver (http://chromedriver.chromium.org) on Linux in an unexpected way when using headless Chrome and having 
display server active:

* Intended input: 'hello'
* Resulting field value: 'llo'

## Observation

Seems that characters 'e', 'r', 's' are translated as functional keys, where 'e' acts as backspace.

Tested/repeated with: 

* Google Chrome 
  * 69.0.3497.100
  * 70.0.3538.110
* ChromeDriver: 
  * 2.42 for Linux 64Bits (acfcc29fb03df9e913ef4c360a121ad1)
  * 2.44.609551 for Linux 64Bits (5d576e9a44fe4c5b6a07e568f1ebc753f1214634)
  
More info: https://bugs.chromium.org/p/chromedriver/issues/detail?id=1771

# Repeating the issue

The guide on how to repeat the issue.

## Pre-requisites

1. Use some Linux distro (issue not repeatable on MacOS, on validation done on Windows)
1. Have Composer installed (https://getcomposer.org)
1. Make sure that display server (xorg) is being used on the terminal session
1. Make sure you have the latest Chrome browser installed.
1. (updating Chrome) `sudo apt-get update && sudo apt-get --only-upgrade install google-chrome-stable`

## Installation

1. `git clone git@github.com:vaimo/chromedriver-send-keys-issue.git`
1. `cd chromedriver-send-keys-issue && composer install`
1. `. scripts/setup.sh` # installs Google Chrome if needed

## Running the tests

1. `composer test` # executes tests with headless chrome
1. (alternative) `composer test -- --use chrome-gui` # executes tests \w visible Chrome GUI

# Fix/workaround

Although it was still repeatable with latest Chrome (70.0.3538.110) and Driver (2.44.609551) releases, I was actually able to get rid of the issue after configuring the keyboard layout in the system before running the tests:

```shell
setxkbmap en_US
```

... which seems to cause the ChromeDriver to use certain letters as if they're function keys. Note that this affects situations where you're running your tests with ChromeDriver against Chrome with GUI.

So why should we care about that when you're using headless chrome?

Well. Turns out that as long as there's DISPLAY environment variable defined, the keyboard layout comes from the display server setup, even when it's not needed. This could be avoided when temporarily resetting the environment value.

```shell
DISPLAY= run_tests # ... where run_tests is your test runner's name/command/script
```
