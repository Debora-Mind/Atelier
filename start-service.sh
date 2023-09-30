#!/bin/bash
echo "Iniciando script de implantação..."

cd frontend

echo "Executando: vue-cli-service build"
vue-cli-service build

# Volte uma pasta para acessar a pasta raiz
cd ..

echo "Entrando no servidor do CodeIgniter"
cd backend

echo "Inicializando o composer"
composer update

echo "Executando: php spark serve"
php spark serve

echo "Script de implantação concluído."
printf 'ok'