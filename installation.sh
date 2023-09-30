#!/bin/bash
echo "Iniciando script de implantação..."

cd frontend
echo "Executando: npm install"
npm install

# Volte uma pasta para acessar a pasta raiz
cd ..
cd backend

echo "Executando: composer update"
composer update

echo "Script de implantação concluído."
