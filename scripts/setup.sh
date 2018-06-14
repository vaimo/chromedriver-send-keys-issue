#!/usr/bin/env bash
: <<'COPYRIGHT'
 Copyright (c) Vaimo Group. All rights reserved.
 See LICENSE_VAIMO.txt for license details.
COPYRIGHT

_is_macosx() {
    if [[ "${OSTYPE}" == "darwin"* ]]; then
        return 0
    fi

    return 1
}

_check_chrome_availablity() {
    if _is_macosx && [ -f /Applications/Google\ Chrome.app/Contents/MacOS/Google\ Chrome ] ; then
        return 0
    fi

    if command -v google-chrome ; then
        return 0
    fi

    return 1
}

if ! _check_chrome_availablity ; then
    if _is_macosx ; then
        echo "Please download Chrome from: $(tput setaf 15)https://www.google.com/chrome$(tput sgr0)"
    else
        echo "$(tput setaf 2)This script will install Google Chrome$(tput sgr0)"
        read -p "Press $(tput setaf 15)ENTER$(tput sgr0) to continue"

        wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -

        echo 'deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main' | sudo tee /etc/apt/sources.list.d/google-chrome.list

        sudo apt-get update
        sudo apt-get -y install google-chrome-stable
        sudo apt-get -y install --reinstall libnss3 # fix for a crash that will happen when running chrome
    fi
else
    echo "$(tput setaf 2)Google Chrome already installed$(tput sgr0)"
fi
