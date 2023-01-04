<?php

function dd($data) {
  echo "<pre style='background: #e0e2e1'>";
  print_r($data);
  echo "</pre>";
}

function df($data) {
  file_put_contents($_SERVER['DOCUMENT_ROOT']. "/debug.txt", json_encode($data) ."\n", FILE_APPEND);
}

