<?php
// PHP 8.3.3-1+ubuntu22.04.1+deb.sury.org+1 (cli) (built: Feb 15 2024 18:38:52) (NTS)

require_once('helpers.php');
use Dzyfhuba\Helpers;

class Siswa
{
  protected $nrp;
  protected $nama;
  protected $daftarNilai;

  public function __construct(
    $nama = null,
    $inggris = null,
    $indonesia = null,
    $jepang = null
  ) {
    $this->nrp = time() . mt_rand();
    $this->nama = $nama ?? Helpers::generateRandomString();
    $this->daftarNilai = [
      'inggris' => $inggris ?? random_int(0, 100),
      'indonesia' => $indonesia ?? random_int(0, 100),
      'jepang' => $jepang ?? random_int(0, 100),
    ];
  }

  public function get_data(){
    return [
      'nrp' => $this->nrp,
      'nama' => $this->nama,
      'daftarNilai' => $this->daftarNilai,
    ];
  }
}

class Nilai
{
  protected $mapel;
  protected $nilai;
}

// generate siswa tunggal
$siswaTunggal = new Siswa('Hafidz', inggris:100);

// generate siswa jamak
$siswaJamak = [];
for ($i=0; $i < 10; $i++) { 
  $siswaJamak[] = new Siswa();
}

header('Content-Type: application/json');
echo json_encode([
  'siswaTunggal' => $siswaTunggal->get_data(),
  'siswaJamak' => array_map(fn ($siswa) => $siswa->get_data(), $siswaJamak),
]);