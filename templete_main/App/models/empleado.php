<?php
namespace App\models;
use App\models\Models;
require_once 'model.php';
class empleado extends Model
{

    protected $table =('empleado');
    protected $table2 =('rol');
    protected $id =('id_e');
    protected $id2 =('id_rol');

}
