#!/usr/bin/env bash

# Apache or Nginx user
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`;

# Mail spool directory
mkdir var/cache; mkdir var/logs;
mkdir var/spool; mkdir var/spool/default;

# Cache/logs folders permissions
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache var/logs var/spool;
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache var/logs var/spool;
