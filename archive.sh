#!/bin/sh

filename="`whoami`-`date +"%Y-%m-%d".tar"

# exclude the uploads directory
find uploads -type d > exclude_list
# eclude this script
echo "$0" >> exclude_list
# exclude the list of excluded files
echo "exclude_list" >> exclude_list

# exclude the database dump
echo "ArtistExchange.sql" >> exclude_list
# exclude database information (e.g., username, password)
echo "dbconnect.php" >> exclude_list
# exclude the archive
echo "$filename" >> exclude_list

tar -c -v -f "$filename" -X exclude_list . 
bzip2 "$filename"

rm -f exclude_list

