<?php

if(count($_POST)==0)
    $_POST = json_decode(file_get_contents('php://input'), true);

$link = $_POST['link'];
$vars = $_POST['vars'];
$sort = $_POST['sort'];

$data = [
    'link'=>$link,
    'vars'=>$vars,
    'sort'=>$sort,
];

file_put_contents('Cache/Vars.json', json_encode($data, JSON_PRETTY_PRINT));