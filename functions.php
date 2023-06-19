<?php

function loadUsers()
{
  $f_json = './users.json';
  if (file_exists($f_json)) {
    return json_decode(file_get_contents($f_json), TRUE);
  }
  return [];
}

function findUser($name)
{
  $users = loadUsers();
  return array_filter($users, function ($user)  use ($name) {
    return $user['name'] === $name;
  });
}

function filterUsers($ageFrom, $ageTo)
{
  $users = loadUsers();
  return array_filter($users, function ($user) use($ageFrom, $ageTo) {
    return ($user['age'] >= $ageFrom) && ($user['age'] <= $ageTo);
  });
}

function addHobby($name, $hobby)
{
  $changedUsers = [];
  $users = loadUsers();
  $targetUsers = array_filter($users, function ($user) use($name, $hobby) {
    return $user['name'] === $name;
  });
  foreach ($targetUsers as $key => $targetUser) {
    $targetUser['hobbies'][] = $hobby;
    $changedUsers[] = $targetUser;
  }
  return $changedUsers;
}

function removeHobby($name, $hobby)
{
  $changedUsers = [];
  $users = loadUsers();
  $targetUsers = array_filter($users, function ($user) use($name, $hobby) {
    return $user['name'] === $name;
  });
  foreach ($targetUsers as $key => $targetUser) {
    $filteredHobbies= array_filter($targetUser['hobbies'], function ($targetHobby) use ($hobby) {
      return $targetHobby != $hobby;
    });
    $targetUser['hobbies'] = $filteredHobbies;
    $changedUsers[] = $targetUser;
  }
  return $changedUsers;
}

function getYoungestUser()
{
  $users = loadUsers();
  $allUsersAge = array_map(function($user) { return $user['age'];}, $users);
  $minUserAge = min($allUsersAge);
  return array_filter($users, function($user) use ($minUserAge) 
    { return $user['age'] === $minUserAge; });
}

function countHobbies($hobby)
{
   $users = loadUsers();
   $counter = 0;
   foreach ($users as $key => $user) {
      $hobbies = $user['hobbies'];
      if (in_array($hobby, $hobbies)) {
        $counter++;
      }
   }
   return $counter;
}

function findUsersBorn($day, $month)
{
  $users = loadUsers();
  return array_filter($users, function($user) use($day, $month) {
    return ($user['birthday']['day'] == $day) && ($user['birthday']['month'] == $month);
  });
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