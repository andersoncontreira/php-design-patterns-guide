FROM nginx:latest

RUN apt-get update && apt-get install -y procps

COPY ./certificate.crt  /etc/nginx/conf.d/certificate.crt
COPY ./certificate.key   /etc/nginx/conf.d/certificate.key
