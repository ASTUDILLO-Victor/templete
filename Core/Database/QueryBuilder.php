<?php
namespace Core\Database;
class QueryBuilder {

    protected $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function selectAll($table) {
        $query=$this->pdo->prepare("SELECT * FROM {$table} where estado=1");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($table,$id) {
        $query=$this->pdo->prepare("SELECT * FROM {$table} WHERE id_e={$id} limit 0,1");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    public function findBy($table,$params) {
        $cols=array_keys($params);
        $cols=implode(' AND ',array_map(function($col){
            return "{$col}=:{$col}";
        },$cols));
        $query=$this->pdo->prepare("SELECT * FROM {$table} WHERE {$cols}");
        $query->execute($params);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create ($table,$params){
        // este trae los indices de create-tasks y implode funciona para traer los datpos una lado de otro separados por la coma 
        $cols=implode(', ',array_keys($params));
        //CON LOS : HACE QUE PDO REMPLACE CON LOS VALORES QUE GUARDAN EN EL INDICE
        $placeholders=':'.implode(', :',array_keys($params));
        $sql="INSERT INTO {$table} ({$cols}) VALUES ($placeholders)";
        // encerramos en un try/cactch por si llega a suceder un error 
        try {
            $query=$this->pdo->prepare($sql);
            //placeholder :name
            //en el arrar tengo ['name'=> 'victor']
            //se guardara en el placeholder victor
            $query->execute($params);
        } catch (\PDOException $ERROR) {
            die($ERROR->getMessage());
        }
        
    }
    public function update ($table,$id,$params){
        // este trae los indices de create-tasks y implode funciona para traer los datpos una lado de otro separados por la coma 
        $cols=array_keys($params);
        $cols=implode(', ',array_map(function($col){
            return "{$col}=:{$col}";
        },$cols));
        //CON LOS : HACE QUE PDO REMPLACE CON LOS VALORES QUE GUARDAN EN EL INDICE
        $sql="UPDATE  {$table} SET {$cols} WHERE id_e=:id";
        // encerramos en un try/cactch por si llega a suceder un error 
        try {
            $query=$this->pdo->prepare($sql);
            //placeholder :name
            //en el arrar tengo ['name'=> 'victor']
            //se guardara en el placeholder victor
            $query->execute([...$params,'id'=>$id]);
        } catch (\PDOException $ERROR) {
            die($ERROR->getMessage());
        }
        
    }
    public function delete ($table,$id){
        // este trae los indices de create-tasks y implode funciona para traer los datpos una lado de otro separados por la coma 
        //CON LOS : HACE QUE PDO REMPLACE CON LOS VALORES QUE GUARDAN EN EL INDICE
        // $sql="DELETE From {$table}  WHERE id=:id";
        $sql="UPDATE  {$table} SET estado= 0 WHERE :id=:id";
        
        // encerramos en un try/cactch por si llega a suceder un error 
        try {
            $query=$this->pdo->prepare($sql);
            //placeholder :name
            //en el arrar tengo ['name'=> 'victor']
            //se guardara en el placeholder victor
            $query->execute(['id'=>$id]);
        } catch (\PDOException $ERROR) {
            die($ERROR->getMessage());
        }
        
    }
}