<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Permissoes extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'descricao' => 'Visualizar Usuários',
                'definicao' => 'Pode visualizar os usuários existentes',
            ],
            [
                'id' => 2,
                'descricao' => 'Criar Usuários',
                'definicao' => 'Pode criar novos usuários',
            ],
            [
                'id' => 3,
                'descricao' => 'Editar Usuários',
                'definicao' => 'Pode editar usuários existentes',
            ],
            [
                'id' => 4,
                'descricao' => 'Excluir Usuários',
                'definicao' => 'Pode excluir usuários existentes',
            ],
            [
                'id' => 5,
                'descricao' => 'Dar permissões',
                'definicao' => 'Pode dar ou remover permissões de usuários',
            ],
            [
                'id' => 6,
                'descricao' => 'Visualizar modelos',
                'definicao' => 'Visualiza os modelos cadastrados',
            ],
            [
                'id' => 7,
                'descricao' => 'Criar modelos',
                'definicao' => 'Pode criar novos modelos',
            ],
            [
                'id' => 8,
                'descricao' => 'Editar modelos',
                'definicao' => 'Pode editar modelos existentes',
            ],
            [
                'id' => 9,
                'descricao' => 'Excluir modelos',
                'definicao' => 'Pode excluir modelos existentes',
            ],
            [
                'id' => 10,
                'descricao' => 'Dar saída',
                'definicao' => 'Da saída no modelo',
            ],
            [
                'id' => 11,
                'descricao' => 'Visualizar valores em modelos',
                'definicao' => 'Visualiza o valor de unitário de cada modelos',
            ],
            [
                'id' => 12,
                'descricao' => 'Configurações',
                'definicao' => 'Visualizar e alterar as configurações do sistema',
            ],
            [
                'id' => 13,
                'descricao' => 'Visualizar Funções',
                'definicao' => 'Visualizar as funções cadastradas',
            ],            [
                'id' => 14,
                'descricao' => 'Criar Funções',
                'definicao' => 'Pode criar novas funções',
            ],            [
                'id' => 15,
                'descricao' => 'Editar Funções',
                'definicao' => 'Pode editar funções existentes',
            ],
            [
                'id' => 16,
                'descricao' => 'Excluir Funções',
                'definicao' => 'Pode excluir funções existentes',
            ],
            [
                'id' => 17,
                'descricao' => 'Editar Dados da Empresa',
                'definicao' => 'Pode alterar o nome e logo da empresa',
            ],
            [
                'id' => 18,
                'descricao' => 'Visualizar Talões',
                'definicao' => 'Visualizar os talões cadastrados',
            ],
            [
                'id' => 19,
                'descricao' => 'Criar Talões',
                'definicao' => 'Pode criar novos talões',
            ],
            [
                'id' => 20,
                'descricao' => 'Editar Talões',
                'definicao' => 'Pode editar talões existentes',
            ],
            [
                'id' => 21,
                'descricao' => 'Excluir Talões',
                'definicao' => 'Pode excluir talões existentes',
            ],
        ];

        $this->db->table('permissoes')->insertBatch($data);
    }
}
