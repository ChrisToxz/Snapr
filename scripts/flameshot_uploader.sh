#!/bin/bash

LOG_FILE="/tmp/uploader.log" ## tail with: `tail -f /tmp/uploader.log`

# Make sure log file exits or create it.
if [ ! -f "$LOG_FILE" ]; then
    touch "$LOG_FILE"
fi
# If --tail passed, tail log file
if [ "$1" == "--tail" ]; then
    echo "Debug mode: Tailing log file: ${LOG_FILE}"
    tail -f "${LOG_FILE}"
    exit 0
fi

###
# API Config
###
API_URL=""

####
# Saving config
###
SAVE_SCREENSHOT=1
BASE_DIR="${HOME}/screenshots"
TARGET_DIR="${BASE_DIR}/$(date +%Y)-$(date +%m)"
FILE_TEMPLATE="screenshot_#WINDOWNAME#_$(date +%Y%m%d_%H%M%S).png"

main() {
    echo "Endpoint: ${API_URL}"
    echo "SAVE_SCREENSHOT: ${SAVE_SCREENSHOT}"

    window_name=$(get_window_name)
    FILE="${FILE_TEMPLATE//#WINDOWNAME#/$window_name}"

    echo "Filename: ${FILE}"

    if [ "$SAVE_SCREENSHOT" -eq 1 ]; then
        # TODO: Could be checked first if it exists?
        mkdir -p "${TARGET_DIR}"
        FILE="${TARGET_DIR}/${FILE}"
    else
       FILE="/tmp/${FILE}"
    fi

    echo "Save path: ${FILE}"

    # Call flameshot
    flameshot gui -r > $FILE

    if [[ -s "$FILE" ]]; then
        # TODO: Move to method
        # TODO: Add filename to post
        response=$(curl \
            -s \
            -H "Authorization: Bearer dev-token" \
            -F "image=@${FILE}" \
            -X POST \
            ${API_URL})

        echo "Upload response:"
        echo "${response}"

        url=$(echo "${response}" | jq -r '.url')
        echo "Image URL: ${url}"
        echo "${url}" | xclip -selection clipboard

        # TODO: Conditional based on response
        notify-send "File uploaded!"
    else
        rm "${FILE}"
        notify-send "File not saved"
    fi
}

###
# Functions
###
get_window_name() {
    local focused_id wm_class
    focused_id=$(xdotool getwindowfocus)
    wm_class=$(xprop -id "$focused_id" WM_CLASS | awk -F\" '{print $4}')
    echo "$wm_class"
}

###
# Run
###
exec > >(while IFS= read -r line; do echo "$(date +'%Y-%m-%d %H:%M:%S') $line"; done >> "$LOG_FILE") 2>&1

echo "---START---"
# TODO: Check if all required commands/packages are available.
# jq, curl, flameshot, xclip
main
echo "---END---"
echo ""
