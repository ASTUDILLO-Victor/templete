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
        // $query = $this->pdo->prepare("SELECT * FROM {$table} where estado=1");
        $query = $this->pdo->prepare("SELECT e.id_e,e.cedula, e.name,e.ape,e.email,r.nombre,e.sexo,e.celu,e.fecha,e.dire FROM {$table} e JOIN rol r on e.id_rol=r.id_rol where e.estado=1");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function selectAll2($table)
    {
        $query = $this->pdo->prepare("SELECT e.id_e,e.cedula, e.name,e.ape,e.email,r.nombre,e.sexo,e.celu,e.fecha,e.dire FROM {$table} e JOIN rol r on e.id_rol=r.id_rol where e.estado=0");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function selectAll3($table)
    {
        // $query = $this->pdo->prepare("SELECT * FROM {$table} where estado=1 AND id_rol='3'");
        $query = $this->pdo->prepare("SELECT e.id_e,e.cedula, e.name,e.ape,e.email,r.nombre,e.sexo,e.celu,e.fecha,e.dire FROM {$table} e JOIN rol r on e.id_rol=r.id_rol where e.estado = 1 
        AND r.id_rol NOT IN (1, 2)");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectAll4($table)
    {
        // $query = $this->pdo->prepare("SELECT * FROM {$table} where estado=0 AND id_rol='3'");
        $query = $this->pdo->prepare("SELECT e.id_e,e.cedula, e.name,e.ape,e.email,r.nombre,e.sexo,e.celu,e.fecha,e.dire FROM {$table} e JOIN rol r on e.id_rol=r.id_rol where e.estado = 0 
        AND r.id_rol NOT IN (1, 2)");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function selectAll5($table2)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table2}");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function selectAll6($table2)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table2} where id_rol NOT IN (1, 2)");
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
        // Validación y saneamiento de datos
        $params = array_map('htmlspecialchars', $params);

        // Preparar los nombres de las columnas y los placeholders
        $cols = implode(', ', array_keys($params));
        $placeholders = ':' . implode(', :', array_keys($params));

        // Construir la consulta SQL
        $sql = "INSERT INTO {$table} ({$cols}) VALUES ({$placeholders})";

        try {
            $stmt = $this->pdo->prepare($sql);

            // Bind parameters
            foreach ($params as $key => &$value) {
                $stmt->bindParam(':' . $key, $value);
            }

            // Ejecutar la consulta
            $stmt->execute();
        } catch (\PDOException $e) {
            // Gestión de errores
            error_log($e->getMessage());
            die("Error al insertar datos en la base de datos.");
        }
    }
    public function select($table, $params)
    {
        // Validación y saneamiento de datos
        // Validación y saneamiento de datos
        $params = array_map('htmlspecialchars', $params);

        // Preparar los nombres de las columnas y los placeholders
        $col = array_keys($params)[0]; // En este caso, solo se necesita la primera columna
        $placeholder = ':' . $col;

        // Construir la consulta SQL
        $sql = "SELECT {$col} FROM {$table} WHERE {$col} = {$placeholder}";

        try {
            $stmt = $this->pdo->prepare($sql);

            // Bind parameter
            $stmt->bindParam($placeholder, $params[$col]);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener el número de filas
            $totalCliente = $stmt->rowCount();

            // Inicializar el array para JSON
            $jsonData = [];

            //Validamos que la consulta haya retornado información
            if ($totalCliente <= 0) {
                $jsonData['success'] = 0;
                $jsonData['message'] = '';
            } else {
                //Si hay datos entonces retornas algo
                $jsonData['success'] = 1;
                $jsonData['message'] = '<p style="color:red;">Ya existe la Cédula <strong>(' . htmlspecialchars($params[$col]) . ')<strong></p>';
            }

            //Mostrando mi respuesta en formato Json
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsonData);

        } catch (\PDOException $e) {
            // Gestión de errores
            error_log($e->getMessage());
            die("Error al seleccionar datos en la base de datos.");
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
        $cols = implode(', ', array_map(function ($key, $value) {
            return "{$key}='{$value}'";
        }, array_keys($params), $params));



        // Construir la consulta SQL
        $sql = "UPDATE {$table} SET {$cols} WHERE id_e={$id}";

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
    public function delete2($table, $id)
    {
        // este trae los indices de create-tasks y implode funciona para traer los datpos una lado de otro separados por la coma 
        //CON LOS : HACE QUE PDO REMPLACE CON LOS VALORES QUE GUARDAN EN EL INDICE
        // $sql="DELETE From {$table}  WHERE id=:id";
        $sql = "UPDATE  {$table} SET estado= 1 WHERE id_e=:id";

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
    public function delete3($table, $id)
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
    public function delete4($table, $id)
    {
        // este trae los indices de create-tasks y implode funciona para traer los datpos una lado de otro separados por la coma 
        //CON LOS : HACE QUE PDO REMPLACE CON LOS VALORES QUE GUARDAN EN EL INDICE
        // $sql="DELETE From {$table}  WHERE id=:id";
        $sql = "UPDATE  {$table} SET estado= 1 WHERE id_e=:id";

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