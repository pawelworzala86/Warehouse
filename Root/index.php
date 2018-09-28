<?php

namespace App;

chdir('../');

require_once('Api/index.php');

require_once('Output.php');

$db = DB::get();

if(isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $db->execute('insert into root_todo (name, description) values (:name, :description)', [
            'name' => $_POST['name'],
            'description' => $_POST['description']
        ]);
    }else if($_POST['action']=='check'){
        $db->execute('update root_todo set done=true where id=?', $_POST['id']);
        exit;
    }
}

$output = new Output();

$todos = $db->getAll('select * from root_todo where done=0 order by id desc');
foreach ($todos as $todo){
    $output->add($todo['id'], $todo['name'], $todo['description'], $todo['done']);
}

$output->out();