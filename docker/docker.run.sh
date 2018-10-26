#!/usr/bin/env bash

readonly NETWORK_NAME="harrek";
docker network inspect ${NETWORK_NAME} > /dev/null || echo "docker network: ${NETWORK_NAME} does not exist, creating... \ndocker network create -d bridge ${NETWORK_NAME}"
docker network inspect ${NETWORK_NAME} > /dev/null || docker network create -d bridge ${NETWORK_NAME};

readonly IMAGE_NAME="harrek/webservice";

readonly CONTAINER_NAME="harrek-webservice";

export EXTERNAL_PORT="8000";
export INTERNAL_PORT="80";

docker run                                          \
    --rm                                            \
    --interactive                                   \
    --tty                                           \
    --hostname api.harrek.com                       \
    --env-file ./docker/env                         \
    --name ${CONTAINER_NAME}                        \
    --network ${NETWORK_NAME}                       \
    --workdir /var/www/html/                        \
    --volume ${PWD}:/var/www/html/                  \
    --publish ${EXTERNAL_PORT}:${INTERNAL_PORT}/tcp \
    ${IMAGE_NAME}
