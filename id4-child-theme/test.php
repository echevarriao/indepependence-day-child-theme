<?php

$yt_video = "https://www.youtube.com/watch?v=NdhyC4Z-J3o";

$yt_url = preg_replace('/watch\?v=/i', 'embed/', $yt_video);

print "\n";
print $yt_url;
print "\n";
?>
