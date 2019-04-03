<?php

namespace Sphp\Manual;

$birth = new \DateTime('1975-09-16 00:25 EET');
$now = new \DateTime();
$age = $now->diff($birth);

md(<<<MD
# WHO AM I? <small>...and does it matter?</small>

**WELL** . . . I am a $age->y years $age->m months and $age->d days old man and I live in
Vasaramäki Turku with my commonlaw
wife. I am a WEB enthusiast and I
am interested in both Client- and
Server-Side WEB programming.
## Other interests
I follow professional basketball, cycling and snooker. And I also enjoy practising first two of these sports myself.
        
Do you want to hire me to do Anything web related... back-end, front-end, testing...
        
Contact me if you do...
 
MD
);
//oadPage('contact');
//include 'samiholck/templates/carousels/videos.php';
?>
