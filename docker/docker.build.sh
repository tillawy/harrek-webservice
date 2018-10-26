#!/usr/bin/env bash

readonly IMAGE_NAME="harrek/webservice";

docker build --tag ${IMAGE_NAME} --file ./Dockerfile .;
