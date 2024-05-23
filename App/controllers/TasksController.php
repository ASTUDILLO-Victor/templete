<?php
namespace App\controllers;
use App\models\empleado;
use App\models\Task;
class TasksController
{
    public function create()
    {
        empleado::create([
            'title' => $_POST['title'],
            'completed' => 0,
            'color' => $_POST['color'],
        ]);
        return redirect('index.php?url=home');

    }
    public function toggle()
    {
        $task = empleado::find($_POST['id']);
        $task->update([
            'completed' => $_POST['completed'],
        ]);
        return redirect('index.php?url=home');
    }
    public function delete()
    {
        $task = empleado::find($_POST['id']);
        $task->delete();
        return redirect('index.php?url=tables');

    }
}