<?php
// PHP 8.3.3-1+ubuntu22.04.1+deb.sury.org+1 (cli) (built: Feb 15 2024 18:38:52) (NTS)

function get_two_highest($list)
{
  rsort($list);

  return array_slice($list, 0, 2);
}

$list = [];
for ($i=0; $i < 5; $i++) { 
  $list[] = random_int(0, 100);
}

header('Content-Type: application/json');
echo json_encode([
  'list' => $list,
  'twoHighest' => get_two_highest($list),
]);