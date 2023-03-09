#!/bin/bash
json-server --host 0.0.0.0 --watch ./docker/node/cepapi-mock/server/db.json --routes ./docker/node/cepapi-mock/server/routes.json --id cep --static docker/node/cepapi-mock/public
