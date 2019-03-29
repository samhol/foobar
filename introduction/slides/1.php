

<h1>Who am I <small> . . . really</small>?</h1>
<?php

namespace Sphp\Manual;

$birth = new \DateTime('1975-09-16 00:25 EET');
$now = new \DateTime();
$age = $now->diff($birth);

md(<<<MD

**WELL** . . . I am a $age->y years $age->m months and $age->d days old man and I live in
Vasaramäki Turku with my commonlaw
wife. I am a WEB enthusiast but I also like working outdoors

MD
);
?>