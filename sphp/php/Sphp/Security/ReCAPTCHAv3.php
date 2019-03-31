<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;
use Sphp\Html\AbstractContent;
/**
 * Implementation of ReCAPTCHAv3
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ReCAPTCHAv3 extends AbstractContent{
  public function getHtml():string {
  return '<script src="https://www.google.com/recaptcha/api.js?render=6Ld3H5sUAAAAAInA__yPC_24WU7OouFxJ7rbWFc5"></script>'.
  '<script>' . "
  grecaptcha.ready(function() {
      grecaptcha.execute('6Ld3H5sUAAAAAInA__yPC_24WU7OouFxJ7rbWFc5', {action: 'homepage'});
  });
  </script>";
  }
  
  /**
   * Checks whether the secret is correct
   * 
   * @param  string $secret
   * @return bool true if the secret is correct and false otherwise
   */
  public static function verify(string $secret): bool {
    $response = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secret,
        'response' => $response
    ];
    $query = http_build_query($data);
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
            "Content-Length: " . strlen($query) . "\r\n",
            'method' => 'POST',
            'content' => $query
        ]
    ];
    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);
    $_SESSION['verificait'] = $verify;;
    return (bool) $captcha_success->success;
  }
}
