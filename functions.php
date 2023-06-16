<?php

function loadUsers()
{
  $f_json = './users.json';
  if (file_exists($f_json)) {
    $jsonStr = file_get_contents("$f_json");
    $json = json_decode($jsonStr, TRUE);
    return $json;
  }
}

function findUser($name, $age)
{
  $users = loadUsers();
  $result = array_filter($users, function ($user)  use ($name) {
    return $user['user']['name'] === $name;
  });
  return $result;
}

function filterUsers($ageFrom, $ageTo)
{
  $users = loadUsers();
  $result = array_filter($users, function ($user) use($ageFrom, $ageTo) {
    return ($user['user']['age'] >= $ageFrom) && ($user['user']['age'] <= $ageTo);
  });
  return $result;
}

function addHobby($name, $hobby)
{
  $users = loadUsers();
  $targetUser = array_filter($users, function ($user) use($name, $hobby) {
    return $user['user']['name'] === $name;
  });
  $targetUser = reset($targetUser);
  if ($targetUser != null) {
    array_push($targetUser['user']['hobbies'], $hobby);
    $result = $targetUser['user']['hobbies'];
  }
  else {
    $result = null;
  }

  return $result;
}

function removeHobby($name, $hobby)
{
  $users = loadUsers();
  $targetUser = array_filter($users, function ($user) use($name, $hobby) {
    return $user['user']['name'] === $name;
  });
  $targetUser = reset($targetUser);
  if ($targetUser != null) {
    $result = array_filter($targetUser['user']['hobbies'], function ($targetHobby) use($hobby) {
      return $targetHobby != $hobby;
    });
  }
  else {
    $result = null;
  }
  return $result;
}

//https://itecnote.com/tecnote/php-how-to-parse-json-into-a-html-table-using-php/
function printJson($arr)
{
   $html = "";
    if ($arr && is_array($arr)) {
        $html .= _arrayToHtmlTableRecursive($arr);
    }
    else if ($arr === null){
      $html = null;
    }
    return $html;
}

function _arrayToHtmlTableRecursive($arr) {
    $str = "<table><tbody>";
    foreach ($arr as $key => $val) {
        $str .= "<tr>";
        $str .= "<td>$key</td>";
        $str .= "<td>";
        if (is_array($val)) {
            if (!empty($val)) {
                $str .= _arrayToHtmlTableRecursive($val);
            }
        } else {
            $str .= "<strong>$val</strong>";
        }
        $str .= "</td></tr>";
    }
    $str .= "</tbody></table>";

    return $str;
}

$jsonTable = printJson(loadUsers());