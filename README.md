# Acceptance test showcase on flawed chromedriver character data processing

This repository illustrates how data that is passed to 'sendKeys' gets interpreted in an unexpected way:

* Intended input: 'hello'
* Resulting field value: 'llo'

Issue only repeatable when running it on Linux and seems NOT to be repeatable when running on Mac.

## Pre-requisites

1. Have composer pre-installed (https://getcomposer.org)

## Installation

1. `git clone git@github.com:vaimo/chromedriver-send-keys-issue.git` 
1. `cd chromedriver-send-keys-issue && composer install`
1. `. scripts/setup.sh` # installs Google Chrome if needed

## Running the tests

1. `composer test` # executes tests with headless chrome
1. (alternative) `composer test -- --use chrome-` # executes tests \w visible Chrome GUI  
