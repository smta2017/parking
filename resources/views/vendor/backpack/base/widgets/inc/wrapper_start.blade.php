@php
	$widget['wrapper']['element'] = $widget['wrapper']['element'] ?? 'div';
	$widget['wrapper']['class'] = $widget['wrapper']['class'] ?? "col-xl-3 col-lg-6 col-12";

    // each wrapper attribute can be a callback or a string
    // for those that are callbacks, run the callbacks to get the final string to use
    foreach($widget['wrapper'] as $attribute => $value) {
        $widget['wrapper'][$attribute] = (!is_string($value) && is_callable($value) ? $value() : $value) ?? '';
    }
@endphp

<{{ $widget['wrapper']['element'] ?? 'div' }}
@foreach(Arr::where($widget['wrapper'],function($value, $key) { return $key != 'element'; }) as $element => $value)
    {{$element}}="{{$value}}"
@endforeach
>