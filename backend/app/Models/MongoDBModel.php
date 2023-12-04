<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\Driver\ServerApi;

abstract class MongoDBModel
{
    protected string $dataBase = 'atelier';
    protected $collection;
    protected Client $mongoClient;

    public function __construct()
    {
        $uri = 'mongodb+srv://debora-almeida:mongodb123@atelier.cmkkw4w.mongodb.net/?retryWrites=true&w=majority';
        $apiVersion = new ServerApi(ServerApi::V1);
        $this->mongoClient = new Client($uri, [], ['serverApi' => $apiVersion]);

        $this->pingMongoDB();
    }

    public function pingMongoDB(): string
	{
        try {
            // Ping para confirmar uma conexão bem-sucedida
            $this->mongoClient->selectDatabase('atelier')->command(['ping' => 1]);
            return "Pinged your deployment. You successfully connected to MongoDB!\n";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function getCollection(): void
	{
		$this->collection = $this->mongoClient->selectCollection($this->dataBase, $this->table);
	}

	private function gerarIdSequencial($collectionName)
	{
		$document = $this->collection->findOne([], ['sort' => ['_id' => -1]]);
		$newId = $document ? iterator_to_array($document) : null;
		if(!$newId) {
			return 1;
		}
		return $newId['id'] + 1;
	}

    public function getAll(): array | string
    {
        try {
            $documents = $this->collection->find();

            return iterator_to_array($documents);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get(string $id): array|string
	{
        try {
            $document = $this->collection->find(['id' => $id]);

            if (!$document) {
                return "Registro não encontrado";
            }

            return iterator_to_array($document);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getBy($field, $value): array|string|null
	{
        try {
            $document = $this->collection->findOne([$field => $value]);

            if (!$document) {
                return null;
            }

            return iterator_to_array($document);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add($data, ? string $unset): string
	{
		if($unset) unset($unset);

		try {
			if (!$data['id']) {
				$id = $this->gerarIdSequencial($this->table);
				$data['id'] = $id;
			}
			$existingDocument = $this->getId($data['id']);

			if ($existingDocument != 'Registro não encontrado') {
				$data['id'] = $existingDocument['id'];
				$updateResult = $this->collection->updateOne(['id' => $existingDocument['id']], ['$set' => $data]);

				if ($updateResult->getModifiedCount() === 1) {
					return "Registro atualizado com sucesso";
				} else {
					return "Falha ao atualizar o registro";
				}
			} else {
				// Inserir um novo documento
				$insertResult = $this->collection->insertOne($data);

				if ($insertResult->getInsertedCount() === 1) {
					return "Registro adicionado com sucesso";
				} else {
					return "Falha ao adicionar o registro";
				}
			}
		} catch (\Exception $e) {
			return $e->getMessage();
		}
    }

	public function delete(int $id): \Exception|bool
	{
		try {
			$result = $this->collection->deleteOne(['id' => $id]);

			return $result->getDeletedCount() > 0;
		} catch (\Exception $e) {
			return $e;
		}
	}

	public function verificarUnicidade($coluna, $valor): bool
	{
		$count = $this->collection->countDocuments([$coluna => $valor]);
		return $count === 0;
	}

}
