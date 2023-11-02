<?php

namespace App\Models;

class UsuariosModel extends MongoDBModel
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['usuario', 'senha', 'funcionario', 'empresa_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function __construct()
    {
        parent::__construct();
        $this->getCollection($this->table);
    }

    protected function getCollection($collectionName)
    {
        $this->collection = $this->mongoClient->selectCollection($this->dataBase, $collectionName);
    }

    public function getUsuarios(): array
    {
        return $this->getAll();
    }

    public function getUsuario($usuario)
    {
        return $this->getBy('usuario', $usuario);
    }

	public function getId($id)
	{
		return $this->getById($id);
	}

	public function add($data)
	{
		unset($data['senhaRepetida']);
		$this->addData($data, $this->table);
	}

	public function delete($id)
	{
		return $this->deleteById($id);
	}
}
