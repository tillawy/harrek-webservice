#!/usr/bin/env bash

eval $(minikube docker-env)

readonly deployment_name="harrek-webservice"

readonly service_name="harrek-webservice-service";

kubectl delete services ${service_name};

kubectl delete deployments ${deployment_name}

kubectl run ${deployment_name} --image=harrek/webservice:latest --image-pull-policy=Never --port=80

kubectl expose deployment ${deployment_name} --type=LoadBalancer --name=${service_name}

minikube service ${service_name};