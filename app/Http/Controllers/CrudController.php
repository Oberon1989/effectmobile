<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


abstract class CrudController
{
    public abstract function create(Request $request);
    public abstract function getAll();
    public abstract function getById($id);
    public abstract function update(Request $request, $id);
    public abstract function deleteById($id);
}
