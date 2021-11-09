@extends('layouts.app')

@section('content')
    {!!Form::open()->put()->route('tidings.update', [$item->id])->fill($item)!!}
        @include('tidings._form');
    {!!Form::close()!!}
@endsection