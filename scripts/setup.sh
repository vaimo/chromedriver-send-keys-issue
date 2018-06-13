#!/usr/bin/env bash
_is_macosx() {
    if [[ "${OSTYPE}" == "darwin"* ]]; then
        return 0
    fi

    return 1
}

if _is_macosx ; then
    echo "Setup script only available on linux os"
    return 1
fi

if ! command -v google-chrome ; then
    echo "$(tput setaf 2)This script will install Google Chrome$(tput sgr0)"
    read -p "Press $(tput setaf 15)ENTER$(tput sgr0) to continue"

    wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | sudo apt-key add -

    echo 'deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main' | sudo tee /etc/apt/sources.list.d/google-chrome.list

    sudo apt-get update
    sudo apt-get -y install google-chrome-stable
    sudo apt-get -y install --reinstall libnss3 # fix for a crash that will happen when running chrome
else
    echo "$(tput setaf 2)Google Chrome already installed$(tput sgr0)"
fi
