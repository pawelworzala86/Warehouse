<?php

$data = json_decode(file_get_contents('Cache/Vars.json'));

echo json_encode($data, JSON_PRETTY_PRINT);