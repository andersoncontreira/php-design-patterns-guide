#!/bin/bash
if test -f ./scripts/preenv.sh; then
    source ./scripts/preenv.sh;
else
    echo './scripts/preenv.sh not found'
fi
export TEST_ENV=1
export LOCALHOST=$(ifconfig docker0| grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1')
docker-compose up $1 $2 $3