#!/bin/bash

# Function to extract share information from smb.conf file
extract_share_info() {
    local line="$1"
    if [[ $line =~ ^\[([^\]]+)\]$ ]]; then
        current_share=${BASH_REMATCH[1]}
        shares+=("$current_share")
        # echo "\n"
        echo "[$current_share]"
    elif [[ $line =~ ^[[:space:]]*path[[:space:]]*=[[:space:]]*(.*)$ ]]; then
        echo "Path:${BASH_REMATCH[1]}"
    elif [[ $line =~ ^[[:space:]]*write[[:space:]]+list[[:space:]]*=[[:space:]]*(.*)$ ]]; then
        echo "Group:${BASH_REMATCH[1]}"
    elif [[ $line =~ ^[[:space:]]*writeable[[:space:]]*=[[:space:]]*(.*)$ ]]; then
        echo "Writable:${BASH_REMATCH[1]}"
    fi
}

# Initialize the array
declare -a shares=()

# Read the smb.conf file
while IFS= read -r line; do
    # Skip comment lines and empty lines
    case "$line" in
        \#*|';'*|'') continue ;;
    esac

    info=$(extract_share_info "$line")
    if [[ -n "$info" ]]; then
        # Add the information to the array
        shares+=("$info")
    fi
done < /etc/samba/smb.conf

# Display the array
echo "Share table:"
for share in "${shares[@]}"; do
    echo "$share"
done
