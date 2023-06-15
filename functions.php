<?php
function loadUsers()
{
  $f_json = './users.json';
  $json = file_get_contents("$f_json");
  echo $json;
  return $json;
}

loadUsers();