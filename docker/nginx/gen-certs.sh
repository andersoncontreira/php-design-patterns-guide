#!/usr/bin/env bash
target_path=$1
if [ -z "$1" ]; then
  target_path="."
fi

out="$target_path/certificate.crt"
keyout="$target_path/certificate.key"
echo $target_path
echo $out
echo $keyout

openssl req -newkey rsa:2048 \
        -x509 \
        -sha256 \
        -nodes \
        -days 1024 \
        -out $out \
        -keyout $keyout \
        -subj "/C=BR/CN=localhost"
