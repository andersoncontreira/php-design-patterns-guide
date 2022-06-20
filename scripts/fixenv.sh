#!/bin/bash
export TEST_ENV=0
docker-compose down -v
docker-compose up --force-recreate --build --renew-anon-volumes