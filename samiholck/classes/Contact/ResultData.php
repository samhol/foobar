<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

/**
 * Description of ResultData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResultData {

  /**
   * @var bool 
   */
  private $valid = true;

  /**
   * @var string[] 
   */
  private $errors;

  /**
   * @var bool 
   */
  private $isSubmitted = false;

  /**
   * @var Contact|null
   */
  private $formData;

  /**
   * @var float
   */
  private $humanScore = 0;

  public function isValid(): bool {
    return $this->valid;
  }

  public function getErrors(): ?array {
    return $this->errors;
  }

  public function getFormData(): Contact {
    return $this->formData;
  }

  public function setValid(bool $valid) {
    if ($valid) {
      $this->unsetErrors();
    }
    $this->valid = $valid;
    return $this;
  }

  public function unsetErrors() {
    $this->errors = [];
    $this->valid = true;
    return $this;
  }

  public function setErrors(array $errors) {
    $this->errors = $errors;
    $this->valid = false;
    return $this;
  }

  public function addError(string $errors) {
    $this->errors[] = $errors;
    $this->valid = false;
    return $this;
  }

  public function setFormData(Contact $formData) {
    $this->formData = $formData;
    return $this;
  }

  public function isSubmitted(): bool {
    return $this->isSubmitted;
  }

  public function setSubmitted(bool $isSubmitted) {
    $this->isSubmitted = $isSubmitted;
    return $this;
  }

  public function getHumanScore(): float {
    return $this->humanScore;
  }

  public function setHumanScore(float $humanScore) {
    $this->humanScore = $humanScore;
    return $this;
  }

}
