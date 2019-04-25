<?php 
    $video_url = $cover->GetValue('video_url');
    $video_title = $cover->GetValue('video_title');
?>
<div class="cover-widget video">
    <h3 class="cover-title">{{$video_title}}</h3>
    <iframe id="ytplayer" type="text/html" src="http://www.youtube.com/embed/{{$video_url}}" frameborder="0">
    </iframe>
</div>