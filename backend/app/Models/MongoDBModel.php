<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\Driver\ServerApi;

abstract class MongoDBModel
{
    protected string $dataBase = 'atelier';
    protected $collection;
    protected Client $mongoClient;
    protected $db;

    public function __construct()
    {
        $uri = 'mongodb+srv://debora-almeida:mongodb123@atelier.cmkkw4w.mongodb.net/?retryWrites=true&w=majority';
        $apiVersion = new ServerApi(ServerApi::V1);
        $this->mongoClient = new Client($uri, [], ['serverApi' => $apiVersion]);

        $this->pingMongoDB();
    }

    public function pingMongoDB()
    {
        try {
            // Ping para confirmar uma conexão bem-sucedida
            $this->mongoClient->selectDatabase('atelier')->command(['ping' => 1]);
            return "Pinged your deployment. You successfully connected to MongoDB!\n";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    abstract protected function getCollection($collectionName);

	private function gerarIdSequencial($collectionName)
	{
		$document = $this->collection->findOne([], ['sort' => ['_id' => -1]]);
		$newId = $document ? iterator_to_array($document) : null;
		if(!$newId) {
			return 1;
		}
		return $newId['id'] + 1;
	}

    protected function getAll(): array | string
    {
        try {
            $documents = $this->collection->find();

            return iterator_to_array($documents);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    protected function getById($id)
    {
        try {
            $document = $this->collection->findOne(['id' => $id]);

            if (!$document) {
                return "Documento não encontrado";
            }

            return iterator_to_array($document);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    protected function getBy($field, $value)
    {
        try {
            $document = $this->collection->findOne([$field => $value]);

            if (!$document) {
                return "Documento não encontrado";
            }

            return iterator_to_array($document);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	abstract public function add($data);

    protected function addData($data, $table)
    {
        try {
			$id = $this->gerarIdSequencial($table);
			$data['id'] = $id;
			$insertResult = $this->collection->insertOne($data);

            if ($insertResult->getInsertedCount() === 1) {
                return "Documento adicionado com sucesso";
            } else {
                return "Falha ao adicionar o documento";
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
