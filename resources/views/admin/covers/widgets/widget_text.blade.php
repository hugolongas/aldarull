<?php
    $text = '';
    if(isset($cover))
    {
        $text = $cover->GetValue('text');
    }
?>
		<div class="form-group">
			<label for="text">Text</label>
        <textarea id="text" name="text" class="form-control">{{$text}}</textarea>
		</div>
@push('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('text');
</script>
@endpush