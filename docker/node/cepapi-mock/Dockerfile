FROM node:12-alpine

WORKDIR /app

RUN npm install -g json-server

COPY ./docker/node/cepapi-mock/server /app/server
COPY ./docker/node/cepapi-mock/public /app/public

EXPOSE 3000

CMD [ "json-server","--host", "0.0.0.0","--watch","/app/server/db.json", "--routes","/app/server/routes.json", "--id", "cep" ]
