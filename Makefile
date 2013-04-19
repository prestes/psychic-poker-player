default: help

help:
	@echo "Available Commands:"
	@echo "install\t\t Install dependencies"
	@echo "update\t\t Update dependencies"
	@echo "test\t\t Run tests"

composer:
	@echo "Verifying Composer.phar"
	wget -nc http://getcomposer.org/composer.phar

install: composer
	@echo "Installing dependencies..."
	php composer.phar install

update: composer
	@echo "Updating dependencies..."
	php composer.phar update

test:
	@echo "Running tests..."
	vendor/bin/phpunit
