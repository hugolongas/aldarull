@extends('layouts.master', ['body_class' => 'weare'])
@section('css')

@endsection
@section('content')
<section id="weare">
    <h1 class="section-title">{{$page->page_title}}</h1>
    <div class="center-section">
        <div  class="weare-container">             
            <div class="col-sm-12 col-md-6">
                <img src="{{asset('/storage/').'/'.$page->img_url}}" class="img-fluid"  alt="{{$page->img_name}}"/>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="weare-text ">
                    {!!Resources::GetResource('coneixens.text')!!}
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@section('js')

@endsection