#!/bin/bash

cd backend

curl -o php-binary.gz https://example.com/php-binary.tar.gz

# Descompacta o PHP
gunzip php-binary.gz

# Executa o PHP local para rodar o install-composer.php
./path-to-php/php install-composer.php

echo "Executando: composer update"
composer update

echo "Executando: php spark serve"
php spark serve

echo "Script de implantação concluído."
