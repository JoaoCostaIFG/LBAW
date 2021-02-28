DOCKER_USERNAME=lbaw2113
IMAGE_NAME=lbaw2113-piu

TARGET=${DOCKER_USERNAME}/${IMAGE_NAME}

push:
	docker build -t ${TARGET} .
	docker push ${TARGET}

run:
	docker run -it -p 8000:80 -v $(shell pwd)/html:/var/www/html ${TARGET}
