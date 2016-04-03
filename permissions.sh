#!/usr/bin/env bash

# Apache or Nginx user
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`;

# Mail spool directory
mkdir app/cache; mkdir app/logs;
mkdir app/spool; mkdir app/spool/default;

# Cache/logs folders permissions
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs app/spool;
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs app/spool;
