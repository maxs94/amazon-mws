#!/bin/bash
php -dxdebug.mode=coverage vendor/bin/phpunit --coverage-text
