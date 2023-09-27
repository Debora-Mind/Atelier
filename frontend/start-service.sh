#!/bin/bash
echo "Iniciando script de implantação..."

echo "Executando: vue-cli-service build"
vue-cli-service build

# Volte uma pasta para acessar a pasta raiz
cd ..

echo "Inicializando o servidor do CodeIgniter"
cd backend
echo "Executando: php spark serve"
php spark serve

echo "Script de implantação concluído."
