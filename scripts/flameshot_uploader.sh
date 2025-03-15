#!/bin/bash

# Config file location
CONFIG_FILE="${HOME}/.config/flameshot_uploader.conf"

# --reset flag to remove config file
if [ "$1" == "--reset" ]; then
    if [ -f "$CONFIG_FILE" ]; then
        rm "$CONFIG_FILE"
        echo "Config file deleted!"
    else
        echo "Config file doesn't exists!"
    fi
    exit 0
fi

# Create config file if not existing
if [ ! -f "$CONFIG_FILE" ]; then
    mkdir -p "$(dirname "$CONFIG_FILE")"
    cat > "$CONFIG_FILE" <<'EOF'
API_URL="http://snapr.test/api/v1/upload"
TOKEN="dev-token"
SAVE_SCREENSHOT=1
BASE_DIR="$HOME/screenshots"
TARGET_DIR="$HOME/screenshots/{year}-{month}"
FILE_TEMPLATE="screenshot_{windowname}_{year}{month}{day}_{time}.png"
LOG_FILE="/tmp/uploader.log"
EOF
fi

# Open config with --config
if [ "$1" == "--config" ]; then
    current_api_url=$(grep '^API_URL=' "$CONFIG_FILE" | cut -d'=' -f2- | tr -d '"')
    current_token=$(grep '^TOKEN=' "$CONFIG_FILE" | cut -d'=' -f2- | tr -d '"')
    current_save_screenshot=$(grep '^SAVE_SCREENSHOT=' "$CONFIG_FILE" | cut -d'=' -f2-)
    current_base_dir=$(grep '^BASE_DIR=' "$CONFIG_FILE" | cut -d'=' -f2- | tr -d '"')
    current_target_dir=$(grep '^TARGET_DIR=' "$CONFIG_FILE" | cut -d'=' -f2- | tr -d '"')
    current_file_template=$(grep '^FILE_TEMPLATE=' "$CONFIG_FILE" | cut -d'=' -f2- | tr -d '"')
    current_log_file=$(grep '^LOG_FILE=' "$CONFIG_FILE" | cut -d'=' -f2- | tr -d '"')

    new_config=$(yad --on-top --width=750 --height=320 --form --title "Flameshot Uploader Config" \
        --text "Available variables: {year}, {month}, {day}, {time}, {windowname}" \
        --field="API URL" "$current_api_url" \
        --field="Token" "$current_token" \
        --field="Save Screenshot" "$current_save_screenshot" \
        --field="Base Directory" "$current_base_dir" \
        --field="Target Directory" "$current_target_dir" \
        --field="File Template" "$current_file_template" \
        --field="Log File" "$current_log_file")

    if [ $? -eq 0 ]; then
         new_api_url=$(echo "$new_config" | cut -d'|' -f1)
         new_token=$(echo "$new_config" | cut -d'|' -f2)
         new_save_screenshot=$(echo "$new_config" | cut -d'|' -f3)
         new_base_dir=$(echo "$new_config" | cut -d'|' -f4)
         new_target_dir=$(echo "$new_config" | cut -d'|' -f5)
         new_file_template=$(echo "$new_config" | cut -d'|' -f6)
         new_log_file=$(echo "$new_config" | cut -d'|' -f7)
         # Write new config values back.
         cat > "$CONFIG_FILE" <<EOF
API_URL="$new_api_url"
TOKEN="$new_token"
SAVE_SCREENSHOT=$new_save_screenshot
BASE_DIR="$new_base_dir"
TARGET_DIR="$new_target_dir"
FILE_TEMPLATE="$new_file_template"
LOG_FILE="$new_log_file"
EOF
         echo "Config changed"
    else
         echo "Config not changed"
    fi
    exit 0
fi

# Source the config file.
source "$CONFIG_FILE"

# Ensure the log file exists.
if [ ! -f "$LOG_FILE" ]; then
    touch "$LOG_FILE"
fi

# If --tail is passed, tail the log file.
if [ "$1" == "--tail" ]; then
    echo "Debug mode: Tailing log file: ${LOG_FILE}"
    tail -f "${LOG_FILE}"
    exit 0
fi

####
# Helper: Replace date/time placeholders in a given string.
####
resolve_placeholders() {
    local input="$1"
    local year=$(date +%Y)
    local month=$(date +%m)
    local day=$(date +%d)
    local time=$(date +%H%M%S)
    echo "$input" | sed "s/{year}/$year/g; s/{month}/$month/g; s/{day}/$day/g; s/{time}/$time/g"
}

# Resolve TARGET_DIR and FILE_TEMPLATE placeholders.
resolved_target_dir=$(resolve_placeholders "$TARGET_DIR")
resolved_file_template=$(resolve_placeholders "$FILE_TEMPLATE")

####
# Main function and file upload logic.
####
main() {
    echo "Endpoint: ${API_URL}"
    echo "Token: ${TOKEN}"
    echo "SAVE_SCREENSHOT: ${SAVE_SCREENSHOT}"
    echo "Base Directory: ${BASE_DIR}"
    echo "Target Directory: ${resolved_target_dir}"
    echo "File Template: ${resolved_file_template}"
    echo "Log File: ${LOG_FILE}"

    # Get the window name.
    window_name=$(get_window_name)
    # Replace the {windowname} placeholder.
    final_file_template=$(echo "$resolved_file_template" | sed "s/{windowname}/$window_name/g")
    FILE="$final_file_template"

    echo "Filename: ${FILE}"

    if [ "$SAVE_SCREENSHOT" -eq 1 ]; then
        mkdir -p "${resolved_target_dir}"
        FILE="${resolved_target_dir}/${FILE}"
    else
       FILE="/tmp/${FILE}"
    fi

    echo "Save path: ${FILE}"

    # Call flameshot to take the screenshot.
    flameshot gui -r > "$FILE"

    if [[ -s "$FILE" ]]; then
        response=$(curl \
            -s \
            -H "Authorization: Bearer ${TOKEN}" \
            -F "image=@${FILE}" \
            -X POST \
            ${API_URL})

        echo "Upload response:"
        echo "${response}"

        url=$(echo "${response}" | jq -r '.url')
        echo "Image URL: ${url}"
        echo "${url}" | xclip -selection clipboard

        notify-send "File uploaded!"
    else
        rm "${FILE}"
        notify-send "File not saved"
    fi
}

get_window_name() {
    local focused_id wm_class
    focused_id=$(xdotool getwindowfocus)
    wm_class=$(xprop -id "$focused_id" WM_CLASS | awk -F\" '{print $4}')
    echo "$wm_class"
}

# Redirect all output to the log file with a timestamp.
exec > >(while IFS= read -r line; do echo "$(date +'%Y-%m-%d %H:%M:%S') $line"; done >> "$LOG_FILE") 2>&1

echo "---START---"
# TODO: Ensure required commands/packages are installed: jq, curl, flameshot, xclip, yad, xdotool, xprop
main
echo "---END---"
echo ""
