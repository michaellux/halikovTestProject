<?php
$findUserResult = '';
$filterUsersResult = '';
$addHobbyResult = '';
$removeHobbyResult = '';
$getYoungestUserResult = '';
$countHobbiesResult = '';
$findUsersBornResult = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['function'])) 
  {
    if ($_GET['function'] === 'findUser') {
        $findUserResult = printJson(findUser($_GET['name'], $_GET['age']));
        if ($findUserResult === '' || $findUserResult === null) {
          $findUserResult = "Пользователь с таким именем и возрастом не найден";
        }
    }
    else if ($_GET['function'] === 'filterUsers') {
       $filterUsersResult = printJson(filterUsers($_GET['ageFrom'], $_GET['ageTo']));
        if ($filterUsersResult === '' || $filterUsersResult === null) {
          $filterUsersResult = "Пользователи не найдены";
        }
    }
    else if ($_GET['function'] === 'addHobby') {
       $addHobbyResult = printJson(addHobby($_GET['name'], $_GET['hobby']));
        if ($addHobbyResult === '' || $addHobbyResult === null) {
          $addHobbyResult = "Пользователь не найден";
        }
    }
    else if ($_GET['function'] === 'removeHobby') {
       $removeHobbyResult = printJson(removeHobby($_GET['name'], $_GET['hobby']));
        if ($removeHobbyResult === '' || $removeHobbyResult === null) {
          $removeHobbyResult = "Пользователь не найден";
        }
    }
    else if ($_GET['function'] === 'getYoungestUser') {
       $getYoungestUserResult = printJson(getYoungestUser());
        if ($getYoungestUserResult === '' || $getYoungestUserResult === null) {
          $getYoungestUserResult = "Пользователь не найден";
        }
    }
    else if ($_GET['function'] === 'countHobbies') {
       $countHobbiesResult = countHobbies($_GET['hobby']);
        if ($countHobbiesResult === '' || $countHobbiesResult === null) {
          $countHobbiesResult = "Пользователь не найден";
        }
    }
    else if ($_GET['function'] === 'findUsersBorn') {
       $findUsersBornResult = printJson(findUsersBorn($_GET['day'], $_GET['month']));
        if ($findUsersBornResult === '' || $findUsersBornResult === null) {
          $findUsersBornResult = "Пользователи не найдены";
        }
    }
  }
}