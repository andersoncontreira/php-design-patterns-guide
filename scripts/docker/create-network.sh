#!/bin/bash
if test -f .projectrc; then
  source .projectrc
elif test -f ./scripts/.projectrc; then
  source ./scripts/.projectrc
fi

if [ -z "$NETWORK_NAME" ]; then
  echo 'NETWORK_NAME not defined'
  exit 1
else
  docker network create --driver bridge $NETWORK_NAME
fi
