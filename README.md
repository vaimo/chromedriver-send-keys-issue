# Acceptance test showcase on flawed chromedriver character data processing

This repository illustrates how data that is passed to 'sendKeys' gets interpreted in an unexpected way:

* Intended input: 'hello'
* Resulting field value: 'llo'

Issue only repeatable when running it on Linux and seems NOT to be repeatable when running on Mac.

## Pre-requisites

1. Have composer pre-installed (https://getcomposer.org)

## Installation

1. clone the repository
2. composer install
3. . scripts/setup.sh # installs Google Chrome if needed

## Running the tests

1. composer test
