#!/bin/bash
# Volte uma pasta para acessar a pasta raiz
cd ..

# Inicialize o servidor do CodeIgniter
cd backend
php spark serve &
cd ..
