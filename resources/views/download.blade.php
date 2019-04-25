@extends('layouts.master', ['body_class' => 'download']) 
@section('css')
@endsection
 
@section('content')
<section id="download">
    <h1 class="section-title">DESCÀRREGUES</h1>
    <div class="center-section">
        <div class="download-container">
            @foreach($downloads as $download)
            <div class="col-sm-12 col-md-6">
                <div class="download-item">
                    <h3 class="file-title">{{$download->file_title}}</h3>
                    <div class="file-desc">{!!$download->file_desc!!}</div>
                    <a href="{{Route('download.file',$download->id)}}" class="btn btn-aldarull" target="_blank" download>{{$download->file_title}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</section>
@endsection