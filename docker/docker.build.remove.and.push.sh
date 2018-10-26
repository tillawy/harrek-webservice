#!/usr/bin/env bash

docker login registry.docker.easydisplay.info

readonly APP_VERSION=$(cat composer.json | grep version | cut -f 4 -d '"');

readonly IMAGE_NAME="harrek/webservice:${APP_VERSION}";

docker build --tag ${IMAGE_NAME} --file ./Dockerfile .;

readonly REGISTRY="registry.docker.easydisplay.info";

echo "\n\n\n\n\t\t • tagging: ${IMAGE_NAME} as: ${REGISTRY}/${IMAGE_NAME} \n\n\n\n";

docker tag ${IMAGE_NAME} ${REGISTRY}/${IMAGE_NAME};

docker push ${REGISTRY}/${IMAGE_NAME};
