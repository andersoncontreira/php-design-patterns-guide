#!/bin/bash
#**********************************
# Variables
#**********************************
current_path=$(pwd)/
current_path_basename=$(basename $(pwd))
current_file_full_path=$0
#echo $current_path_basename
#**********************************
# Nginx certificates
#**********************************
if [ $current_path_basename = "scripts" ]; then
  if ! test -f ../docker/nginx/certificate.crt; then
    ../docker/nginx/gen-certs.sh ../docker/nginx
  fi
else
  if ! test -f ./docker/nginx/certificate.crt; then
    ./docker/nginx/gen-certs.sh ./docker/nginx
  fi
fi
#**********************************
# Lumen storage
#**********************************
if [ $current_path_basename = "scripts" ]; then
  ./lumen/create-storage.sh
else
  ./scripts/lumen/create-storage.sh
fi
#**********************************
# ELK flags
#**********************************
# pre requirements for ELK
#sudo sysctl -w -q vm.max_map_count=262144
#sudo sysctl -w -q fs.file-max=65536
#ulimit -n 65536
#ulimit -u 4096
#ulimit -c unlimited
