<?php
    $link_url = '';
    $text_info = '';
    if(isset($cover))
    {
        $link_url = $cover->GetValue('link_url');
        $text_info = $cover->GetValue('text_info');
    }
?>
		<div class="form-group">
			<label for="link_url">Fitxer: </label>
			@if ($link_url!='')
			<a href="{{ asset('/storage/').'/'.$link_url}}">{{$link_url}}</a>				
			@endif
        <input type="file" name="link_url" id="link_url" class="form-control" value="" />			
		</div>		
		<div class="form-group">
			<label for="text_info">Text portada</label>
        <textarea id="text_info" name="text_info" class="form-control">{{$text_info}}</textarea>
		</div>
@push('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('text_info');
</script>
@endpush