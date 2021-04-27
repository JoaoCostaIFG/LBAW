DOCKER_USERNAME=lbaw2113
IMAGE_NAME=lbaw2113

TARGET=${DOCKER_USERNAME}/${IMAGE_NAME}

push:
	docker build -t ${TARGET} .
	docker push ${TARGET}

compose:
	docker-compose up

.PHONY: push compose
