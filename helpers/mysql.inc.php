<?php

// A simple MySQL dump
function print_mysql_dump() {
  header('Content-type: text/plain');
  $tables = mysql_query('SHOW TABLES');
  while ($table_row = mysql_fetch_row($tables)) {
    $table = $table_row[0];

    $q = mysql_query("SHOW CREATE TABLE $table");
    $l = mysql_fetch_row($q);
    echo "DROP TABLE IF EXISTS `$table`;\n";
    echo $l[1].";\n";

    $fields = array();
    $q = mysql_query("SHOW COLUMNS FROM $table");
    while ($l = mysql_fetch_row($q))
      $fields[] = '`'.$l[0].'`';

    $q = mysql_query("SELECT * FROM $table");
    while ($line = mysql_fetch_row($q)) {

      foreach ($line as $k => $f)
        $line[$k] = "'".mysql_real_escape_string($f)."'";

      echo "INSERT INTO $table (".implode($fields, ', ').") " .
        "VALUES (".implode($line, ', ').");\n";
    }
    echo "\n\n";
  }
}
