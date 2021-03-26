<?php
namespace App\Repositories;
use App\Models\Categoria;
use App\Repositories\Repository;

class CategoriaRepository extends Repository
{
    protected function getClass()
    {
        return Categoria::class;
    }
}