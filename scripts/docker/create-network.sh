#!/bin/bash
if test -f .projectrc; then
  source .projectrc
elif test -f ./scripts/.projectrc; then
  source ./scripts/.projectrc
fi

if [ -z "$APP_DOCKER_NETWORK_NAME" ]; then
  echo 'APP_DOCKER_NETWORK_NAME not defined'
  exit 1
else
  docker network create --driver bridge $APP_DOCKER_NETWORK_NAME
fi
