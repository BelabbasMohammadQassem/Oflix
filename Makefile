# Makefile pour automatiser les tâches Docker

# Variables
IMAGE_NAME := qassem1/oflix_frankensf
TAG := latest

# Construire l'image Docker
.PHONY: build
build:
	@docker build -t $(IMAGE_NAME):$(TAG) .

# Pusher l'image sur Docker Hub
.PHONY: push
push:
	@docker push $(IMAGE_NAME):$(TAG)

# Puller l'image depuis Docker Hub
.PHONY: pull
pull:
	@docker pull $(IMAGE_NAME):$(TAG)

# Commande par défaut
.PHONY: all
all: build
