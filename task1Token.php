<?php
class Token
{
  public $tokens = [];
  function generate($user)
  {
    // generate
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $token = '';
    for ($i = 0; $i < $length; $i++) {
      $token .= $characters[rand(0, $charactersLength - 1)];
    }
    if ($this->tokens[$user]) {
      // add element to last
      $this->tokens[$user] = [...$this->tokens[$user], $token];

      // remove last if reach 10 elements
      if (count($this->tokens[$user]) > 10) {
        array_shift($this->tokens[$user]);
      }
    } else {
      // initial
      $this->tokens[$user] = [$token];
    }
    return $token;
  }

  function verify_token($user, $token)
  {
    if(!$this->tokens[$user]) {
      throw new Exception("generate token first", 500);
    }
    // echo in_array($token, $this->tokens[$user]);
    if (isset($this->tokens[$user]) && in_array($token, $this->tokens[$user])) {
      array_shift($this->tokens[$user]);
      return true;
    } else {
      return false;
    }
  }

  function get_tokens()
  {
    return $this->tokens;
  }
}

$token = new Token();

// user: hafidz
for ($i = 0; $i < 10; $i++) {
  $token->generate('hafidz');
}
$batch1 = $token->get_tokens();


$token_correct = $token->generate('hafidz');
$batch2 = $token->get_tokens();

$token_wrong = $token_correct."waduh";

// false check: test1
$test1 = $token->verify_token('hafidz', $token_wrong);
$batch3 = $token->get_tokens();

// true check: test2
$test2 = $token->verify_token('hafidz', $token_correct);
$batch4 = $token->get_tokens();

// another user: ubaidillah
$test3 = $token->generate('ubaidillah');
$batch5 = $token->get_tokens();

header('Content-Type: application/json');
print_r(json_encode([
  'tokens_batch1' => [
    'lenght' => count($batch1['hafidz']),
    'tokens' => $batch1['hafidz']
  ],
  'tokens_batch2' => [
    'lenght' => count($batch2['hafidz']),
    'tokens' => $batch2['hafidz']
  ],
  
  'test1' => $test1,
  'token_wrong' => $token_wrong,
  'tokens_batch3' => [
    'lenght' => count($batch3['hafidz']),
    'tokens' => $batch3['hafidz']
  ],

  'test2' => $test2,
  'token_correct' => $token_correct,
  'tokens_batch4' => [
    'lenght' => count($batch4['hafidz']),
    'tokens' => $batch4['hafidz']
  ],

  'test3' => $test3,
  'tokens_batch5' => [
    'lenght' => count($batch5['ubaidillah']),
    'tokens' => $batch5['ubaidillah']
  ],

  'tokens_batch_all' => $token->get_tokens(),
]));