FROM ubuntu

RUN apt-get update && apt-get install -y \
curl \
nginx

RUN apt-get update && apt-get install -y mysql-server

EXPOSE 80