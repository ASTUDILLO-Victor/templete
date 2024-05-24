<?php
namespace Core\Database;

class QueryBuilder
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function selectAll($table)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table} where estado=1");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($table, $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE id_e={$id} limit 0,1");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    public function findBy($table, $params)
    {
        $cols = array_keys($params);
        $cols = implode(' AND ', array_map(function ($col) {
            return "{$col}=:{$col}";
        }, $cols));
        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$cols}");
        $query->execute($params);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($table, $params)
    {
        // este trae los indices de create-tasks y implode funciona para traer los datpos una lado de otro separados por la coma 
        $cols = implode(', ', array_keys($params));
        
        $placeholders = ':' . implode(', :', array_keys($params));
        $sql = "INSERT INTO {$table} (id_e, cedula, name, email, password, posición, oficina, direcion, estado) VALUES ({$placeholders})";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
        } catch (\PDOException $ERROR) {
            die($ERROR->getMessage());
        }

    }
    public function update($table, $id, $params)
{
    // Suponiendo que el campo de cédula se llama 'cedula'
    if (isset($params['cedula'])) {
        $cedula = $params['cedula'];
       
        // Verificar si la cédula ya existe en la tabla
        $checkSql = "SELECT COUNT(*) FROM {$table} WHERE cedula = '{$cedula}' AND id_e != {$id}";
        try {
            $result = $this->pdo->query($checkSql);
            $count = $result->fetchColumn();
            
            if ($count > 0) {
                // Si la cédula ya existe, enviar una alerta
                $mensaje = "Cédula {$cedula} ya registrada.";
                header("Location: index.php?url=tables&mensaje=" . urlencode($mensaje)); // Redirección después de 3 segundos
            exit();
                // die("La cédula {$cedula} ya está registrada.");
            }
        } catch (\PDOException $ERROR) {
            die($ERROR->getMessage());
        }
    }
    // Construir la parte SET de la consulta SQL con los valores directamente
    $cols = implode(', ', array_map(function($key, $value) {
        return "{$key}='{$value}'";
    }, array_keys($params), $params));


    
    // Construir la consulta SQL
    $sql = "UPDATE {$table} SET {$cols} WHERE {$id}={$id}";
    
    // Encerrar en un try/catch por si ocurre un error
    try {
        // Ejecutar la consulta directamente
        $this->pdo->query($sql);
    } catch (\PDOException $ERROR) {
        die($ERROR->getMessage());
    }
}
    public function delete($table, $id)
    {
        // este trae los indices de create-tasks y implode funciona para traer los datpos una lado de otro separados por la coma 
        //CON LOS : HACE QUE PDO REMPLACE CON LOS VALORES QUE GUARDAN EN EL INDICE
        // $sql="DELETE From {$table}  WHERE id=:id";
        $sql = "UPDATE  {$table} SET estado= 0 WHERE id_e=:id";

        // encerramos en un try/cactch por si llega a suceder un error 
        try {
            $query = $this->pdo->prepare($sql);
            //placeholder :name
            //en el arrar tengo ['name'=> 'victor']
            //se guardara en el placeholder victor
            $query->execute(['id' => $id]);
        } catch (\PDOException $ERROR) {
            die($ERROR->getMessage());
        }

    }
}