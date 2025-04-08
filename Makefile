SRC_DIR := src
TEST_DIR := tests
VENDOR_DIR := vendor
DC := docker-compose
PHP_CONTAINER := php
PHP_IMAGE := php:8.1-cli

COMPOSER := composer
PHPUNIT := ./vendor/bin/phpunit
PHPSTAN := ./vendor/bin/phpstan
PHPCS  := ./vendor/bin/phpcs
PHPCBF := ./vendor/bin/phpcbf

.PHONY: help install tests phpstan phpcs docker-build docker-up docker-down...

help:
	@echo "  make docker-build   # Build the Docker image"
	@echo "  make docker-up      # Start Docker services"
	@echo "  make docker-down    # Stop Docker services"
	@echo "  make docker-shell   # Launching interactive terminal in the PHP container..."

	@echo ""
	@echo "  The following commands must be executed inside the container (make docker-shell)"
	@echo "  make install        # Install Composer dependencies"
	@echo "  make tests          # Run PHPUnit tests"
	@echo "  make phpstan        # Analyze code with PHPStan"
	@echo "  make phpcs          # Check code standards with PHP_CodeSniffer"
	@echo "  make phpcs-fix      # Check code standards with PHP_CodeSniffer and fix it.."


docker-build:
	@echo "Building the Docker image..."
	@docker build -t $(PHP_IMAGE) .

docker-up:
	@echo "Starting Docker services..."
	$(DC) up -d

docker-down:
	@echo "Stopping Docker services..."
	$(DC) down

docker-shell:
	@echo "Launching interactive terminal in the PHP container..."
	$(DC) exec -ti $(PHP_CONTAINER) bash

install:
	@echo "Installing dependencies with Composer..."
	composer install

tests:
	@echo "Running PHPUnit tests..."
	$(PHPUNIT) --config phpunit.xml.dist

phpstan:
	@echo "Analyzing code with PHPStan..."
	$(PHPSTAN) analyse $(SRC_DIR)

phpcs:
	@echo "Checking code standards with PHP_CodeSniffer..."
	$(PHPCS) --standard=phpcs.xml $(SRC_DIR)

phpcs-fix:
	@echo "Fixing code standards with PHP_CodeSniffer..."
	$(PHPCBF) --standard=phpcs.xml $(SRC_DIR)


