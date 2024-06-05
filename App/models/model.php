<?php
namespace App\models;

use Core\app;

class Model
{
    protected $properties = [];
    protected $table;

    protected $id;

    public function __construct($properties = [])
    {
        $this->properties = $properties;
    }

    public static function all()
    {
        $model = new static;
        $rows = App::get('database')->selectAll($model->getTable());
        return array_map(fn($row) => new static($row), $rows);


    }
    public static function all2()
    {
        $model = new static;
        $rows = App::get('database')->selectAll2($model->getTable());
        return array_map(fn($row) => new static($row), $rows);


    }
    public static function all3()
    {
        $model = new static;
        $rows = App::get('database')->selectAll3($model->getTable());
        return array_map(fn($row) => new static($row), $rows);


    }
    public static function all4()
    {
        $model = new static;
        $rows = App::get('database')->selectAll4($model->getTable());
        return array_map(fn($row) => new static($row), $rows);


    }
    public static function all5()
    {
        $model = new static;
        $rows = App::get('database')->selectAll5($model->getTable2());
        return array_map(fn($row) => new static($row), $rows);


    }
    public static function all6()
    {
        $model = new static;
        $rows = App::get('database')->selectAll6($model->getTable2());
        return array_map(fn($row) => new static($row), $rows);


    }
   
    public static function create($properties)
    {
        $model = new static($properties);
        $model->save();

        return $model;
    }

    public function update($properties)
{
    App::get('database')->update($this->getTable(), $this->properties[$this->getid()], $properties);

    $this->setProperties($properties);
    return $this;
}

    public function delete()
    {
        App::get('database')->delete($this->getTable(), $this->properties[$this->getid()]);

        return $this;
    }
    public function delete2()
    {
        App::get('database')->delete2($this->getTable(), $this->properties[$this->getid()]);

        return $this;
    }
    public function delete3()
    {
        App::get('database')->delete3($this->getTable(), $this->properties[$this->getid()]);

        return $this;
    }
    public function delete4()
    {
        App::get('database')->delete4($this->getTable(), $this->properties[$this->getid()]);

        return $this;
    }
    // actualizar
    public static function find($id)
    {
        $model = new static;
        $properties = App::get('database')->find($model->getTable(), $id);
        $model->setProperties($properties);
        return $model;
    }
    

    public static function findBy($param)
    {
        $model = new static;
        $rows = App::get('database')->findBy($model->getTable(), $param);
        return array_map(fn($row) => new static($row), $rows);


    }

    //save es para crear o insertar
    public function save($name = null)
    {
        if (empty($this->table)) {
            throw new \Exception("El nombre de la tabla no fue definido");
        }
        App::get('database')->create($this->table, $this->properties);
    }

    public function getTable()
    {
        return $this->table;

    }
    public function getTable2()
    {
        return $this->table2;

    }
    public function getid()
    {
        return $this->id;

    }
    public function setProperties($properties)
    {
        $this->properties = array_merge($this->properties, $properties);

        return $this;
    }
    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        return null;
    }
}