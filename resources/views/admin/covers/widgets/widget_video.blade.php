<?php
    $video_title = '';
    $video_url = '';
    if(isset($cover))
    {
        $video_url = $cover->GetValue('video_url');
        $video_title = $cover->GetValue('video_title');
    }
?>
    <div class="form-group">
        <label for="video_title">títol del video</label>
        <input id="video_title" name="video_title" class="form-control" value="{{$video_title}}" />
    </div>
    <div class="form-group">
        Indicar la url o el ID: (https://www.youtube.com/watch?v=352QnykhgHw o 352QnykhgHw)
        <label for="video_url">Url del video</label>
        <input id="video_url" name="video_url" class="form-control" value="{{$video_url}}" />
    </div>