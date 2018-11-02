#!/usr/bin/env bash

eval $(minikube docker-env)

readonly deployment_name="harrek-webservice"

readonly service_name="harrek-webservice-service";

readonly namespace_name="harrek";

kubectl delete namespaces ${namespace_name}

kubectl apply -f docker/k8s.yaml

kubectl run ${deployment_name} --image=harrek/webservice:latest --image-pull-policy=Never --namespace=${namespace_name} --port=80

kubectl expose deployment ${deployment_name} --type=LoadBalancer --namespace=${namespace_name} --name=${service_name}

minikube service ${service_name} --namespace=${namespace_name};
