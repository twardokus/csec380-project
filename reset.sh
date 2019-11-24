#!/bin/bash
# Use this to reset docker

docker container rm $(docker ps -aq)
docker image rm $(docker image ls -q)
docker volume rm $(docker volume ls -q)
