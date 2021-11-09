@extends('layouts.app')

@section('content')
    {!!Form::open()->post()->route('tidings.store')!!}
        @include('tidings._form');
    {!!Form::close()!!}
@endsection