#!/bin/bash
echo "Iniciando script de implantação..."

cd frontend
echo "Executando: npm install"
npm install

echo "Executando: vue-cli-service build"
vue-cli-service build

# Volte uma pasta para acessar a pasta raiz
cd ..
cd backend

echo "Executando: composer update"
composer update

echo "Executando: php spark serve"
php spark serve

echo "Script de implantação concluído."
