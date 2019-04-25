<?php 
    $link_url = $cover->GetValue('link_url');
    $text_info = $cover->GetValue('text_info');
?>
<div class="cover-widget file">
    <div class="logo-header"></div>
    <div class="cover-text">
        {!!$text_info!!}
    </div>
    <a class="btn btn-aldarull" href="{{ Route('index.getDownload',$cover->id)}}" >DESCARREGAR!</a>
</div>