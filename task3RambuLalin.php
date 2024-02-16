<?php
// PHP 8.3.3-1+ubuntu22.04.1+deb.sury.org+1 (cli) (built: Feb 15 2024 18:38:52) (NTS)

class LaluLintas
{
  protected $indicator = ['merah', 'kuning', 'hijau'];
  protected $lampu;

  public function trigger()
  {
    $lampu = $this->lampu ?? 'hijau';
    $idx = array_search($lampu, $this->indicator);
    $this->lampu = $this->indicator[++$idx % 3];

    return $this->lampu;
  }
}

$laluLintas = new LaluLintas();

$triggers = [];

for ($i=0; $i < 10; $i++) { 
  $triggers[] = $laluLintas->trigger();
}

header('Content-Type: application/json');
echo json_encode($triggers);