<?php
require_once('helpers.php');
use Dzyfhuba\Helpers;

// PHP 8.3.3-1+ubuntu22.04.1+deb.sury.org+1 (cli) (built: Feb 15 2024 18:38:52) (NTS)

function countMostUsedChar($word)
{
  $counter = [];
  $mostUsed = [];
  foreach (str_split($word) as $char) {
    $counter[$char] = isset($counter[$char]) ? $counter[$char] + 1 : 1;
    if ($highest < $counter[$char])
      $highest = $counter[$char];
  }
  foreach ($counter as $key => $value) {
    if ($highest === $value)
      $mostUsed = [$key => $value];
  }

  $keyFirst = array_key_first($mostUsed);
  $valueFirst = $mostUsed[$keyFirst];
  return "$keyFirst {$valueFirst}x";
}

header('Content-Type: application/json');
echo json_encode([
  'wellcome' => countMostUsedChar('wellcome'),
  'strawberry' => countMostUsedChar('strawberry'),
  'random' => array_map(function () {
    $word = Helpers::generateRandomString(20);
    return [
      'word' => $word,
      'mostUsed' => countMostUsedChar($word),
    ];
  }, range(0, 10))
]);