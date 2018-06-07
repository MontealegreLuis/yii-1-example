SHELL = /bin/bash

.PHONY: setup test

setup:
	@echo "Installing composer dependencies"
	@composer install
	@echo "Installing npm dependencies"
	@npm install

test:
	@echo "Running acceptance test suite"
	@bin/codecept acceptance --steps
