<?php

namespace Sphp\Html\Foundation\Sites\Bars;
?>
<pre>
  <?php

  use Sphp\Data\Person;
  use Sphp\Stdlib\Parser;

$u = new \Sphp\Data\Person(['lname' => 'foo']);
  $u['fname'] = 'Sami';
  $u['address']['street'] = 'Rakuuna';
  $u['dateOfBirth'] = new \DateTime();
  unset($u['dateOfBirth']);

  try {
    //unset($u['foo']);
  } catch (\Exception $ex) {
    echo $ex;
  }
  echo $u;
  $data = Parser::json()->decodeFromFile('http://data.samiholck.com/');
  // print_r($data);
  $person = new Person($data);
  print_r($person->toArray());
echo $person;
  use Sphp\Html\Lists\Ul;
  use Sphp\Html\Media\Icons\FontAwesome;
  ?>
</pre>
<ul class="fa-ul">
  <li>
    <span class="fa-li"><?php FontAwesome::user('Name')->printHtml() ?></span> 
    <strong><?php echo $person->getFullname() ?></strong></li>
  <li>
    <span class="fa-li"><?php FontAwesome::phone('phonenumber')->printHtml() ?></span> 
    <?php echo $person->getPhonenumber() ?></li>
  <li>
    <span class="fa-li"><?php FontAwesome::envelope('Email address')->printHtml() ?></span> 
    <?php echo $person->getEmail() ?></li>
  <li>
    <span class="fa-li"><?php FontAwesome::get('fa fa-map-marker-alt', 'Email address')->printHtml() ?></span> 
    <?php echo $person->getAddress() ?></li>
</ul>
<?php

use Sphp\Html\Media\Icons\BrandIcons;

$bi = new BrandIcons();
$bi->setGithub('https://github.com/samhol', 'Gihub repository', 'github');
$bi->appendFacebook('https://www.facebook.com/sami.holck', 'Facebook page', 'fb');
$bi->appendGooglePlus('https://plus.google.com/u/0/107385804268206063694', 'Google plus page', 'google');
$bi->appendTwitter('https://twitter.com/SPHPframework', 'Twitter page', 'twitter');
$bi->printHtml();
?>
