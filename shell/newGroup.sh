#!/bin/bash

# Function to display usage information
usage() {
    echo "Usage: $0 -n <share_name> -p <path> [-w <yes|no>] [-g <write_list>]"
    exit 1
}

# Parse command-line arguments
while getopts "n:p:w:g:" opt; do
    case "$opt" in
        n) share_name="$OPTARG" ;;
        p) path="$OPTARG" ;;
        w) writable="$OPTARG" ;;
        g) write_list="$OPTARG" ;;
        *) usage ;;
    esac
done

# Validate mandatory parameters
if [ -z "$share_name" ] || [ -z "$path" ]; then
    usage
fi

# Default writable to yes if not specified
if [ -z "$writable" ]; then
    writable="yes"
fi

# Add the new share to smb.conf
{
    echo ""
    echo "[$share_name]"
    echo "   path = $path"
    echo "   writable = $writable"
    if [ -n "$write_list" ]; then
        echo "   write list = $write_list"
    fi
} >> /etc/samba/smb.conf

echo "Share [$share_name] added successfully."
