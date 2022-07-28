#!/usr/bin/env bash

openssl req -newkey rsa:2048 \
        -x509 \
        -sha256 \
        -nodes \
        -days 1024 \
        -out certificate.crt \
        -keyout certificate.key \
        -subj "/C=BR/CN=localhost"
