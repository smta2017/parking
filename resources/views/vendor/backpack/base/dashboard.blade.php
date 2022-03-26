@extends(backpack_view('blank'))

@php
    $widgets['before_content'][] = [
    'type'        => 'progress',
    'class'       => 'card text-white bg-danger mb-2',
    'value'       => '11.456',
    'description' => 'Registered users.',
    'progress'    => 57, // integer
];
    $widgets['before_content'][] = [
    'type'        => 'progress',
    'class'       => 'card text-white bg-primary mb-2',
    'value'       => '11.456',
    'description' => 'Registered users.',
    'progress'    => 57, // integer,
    'progressClass' => 'progress-bar bg-primary'
];
    $widgets['before_content'][] = [
    'type'        => 'progress',
    'class'       => 'card text-white bg-danger mb-2',
    'value'       => '11.456',
    'description' => 'Registered users.',
    'progress'    => 57, // integer
];
    $widgets['before_content'][] = [
    'type'        => 'progress',
    'class'       => 'card text-white bg-light mb-2',
    'value'       => '11.456',
    'description' => 'Registered users.',
    'progress'    => 57, // integer
];
@endphp

@section('content')
@endsection