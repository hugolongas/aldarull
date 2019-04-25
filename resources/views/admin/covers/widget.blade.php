<div class="cover-widget" id="{{$cover->id}}">
    <h2>{{$cover->GetWidget()->widget_type}}</h2>
    @foreach ($cover->WidgetData()->i as $param)
        @switch($param->type)
            @case('file')
            <div class="widget-file">
                Fitxer: <a href="{{ asset('/storage/').'/'.$param->value}}">{{$param->value}}</a>
            </div>
            @break
            @case('checkbox')
            <div class="widget-checkbox">
                Actiu: {{$param->value}}
            </div>
            @break
            @case('textarea')
            <div class="widget-textarea">
                Text: {!!$param->value!!}
            </div>
            @break
            @case('textbox')
                url: {{$param->value}}
            @break
        @endswitch
    @endforeach
        <a class="btn btn-info editar-widget" role="button" href="{{ route("admin.cover.edit", $cover->id) }}"><i class="fa fa-pencil-alt"></i>Editar</a>
        <button class="btn btn-danger eliminar-widget" data-id="{{$cover->id}}">Eliminar</button>
</div>