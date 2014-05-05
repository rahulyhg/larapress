
@if (Session::has('formMessage'))
<div class="alert alert-success">
    {{ Session::get('formMessage') }}
</div>
@endif

@foreach ($fields as $fieldName => $options)

@if($editing == true && $options['editable'] == 'true' || $editing == false)

<div class="form-group{{ $errors->has($fieldName) ? ' has-error' : '' }}">


    {{ Form::label($fieldName, $options["label"], array('class' => 'control-label contact-form-'.$fieldName.'-label')) }}

    @if ($options['type'] == 'textarea')
    {{ Form::textarea($fieldName, Input::old($fieldName), array('class' => 'HTMLeditor form-control', 'placeholder' => $options["placeholder"])) }}
    @elseif ($options['type'] == 'select')
    {{ Form::select($fieldName, $options['choices'], Input::old($fieldName), array('class' => 'form-control', 'placeholder' => $options["placeholder"])) }}
     @elseif ($options['type'] == 'file')
    {{ Form::file($fieldName, array('class' => 'form-control')) }}
    @else
    {{ Form::text($fieldName, Input::old($fieldName), array('class' => 'form-control', 'placeholder' => $options["placeholder"])) }}
    @endif

    @if ($errors->has($fieldName))
    <span class="help-block">{{ $errors->first($fieldName) }}</span>
    @endif


</div>
@endif

@endforeach
 
{{ Form::submit('submit') }}
