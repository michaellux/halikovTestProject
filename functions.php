<?php
function loadUsers()
{
  $f_json = './users.json';
  if (file_exists($f_json)) {
    $json = file_get_contents("$f_json");
    return $json;
  }
}

//https://itecnote.com/tecnote/php-how-to-parse-json-into-a-html-table-using-php/
function printJson()
{
  //echo 'test';
   $arr = $data = json_decode(loadUsers(), TRUE);
   //echo $arr;
   $html = "";
    if ($arr && is_array($arr)) {
        $html .= _arrayToHtmlTableRecursive($arr);
    }
    echo $html;
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

printJson();