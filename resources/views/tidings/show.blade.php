@extends('layouts.app')

@section('content')
        <p>{{$item->manchete}}</p>
        <p>{{$item->title_tiding}}</p>
        <p>{{$item->description_tiding}}</p>
        <p>{{$item->created_at}}</p>
        <p>{{$item->updated_at}}</p>
@endsection