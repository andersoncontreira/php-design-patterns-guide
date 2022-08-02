#!/bin/bash
if test -f .projectrc; then
  source .projectrc
elif test -f ./scripts/.projectrc; then
  source ./scripts/.projectrc
fi

if [ -z "$APP_DOCKER_NAME" ]; then
  echo 'APP_DOCKER_NAME not defined'
  exit 1
else
  docker-compose exec $APP_DOCKER_NAME /bin/sh
fi
