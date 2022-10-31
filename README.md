Test API Installation
============================================

### SetUp
Run this command to start with Test API
* `make init` - This command will build docker, install composer, create database, run migrations and load fixtures
* after this, all should be set up and you can navigate to http://localhost:8080/winner in your browser
* for running unit tests, you can run `make test-unit` command

For stopping all containers, you should run `make stop`. Additionally, you can check Makefile for other useful scripts.
