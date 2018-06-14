# Acceptance test showcase on flawed chromedriver character data processing

This repository illustrates how data that is passed to 'sendKeys' gets interpreted in an unexpected way:

* Intended input: 'hello'
* Resulting field value: 'llo'

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
1. (alternative) `composer test -- --use chrome-` # executes tests \w visible Chrome GUI  
