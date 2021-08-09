@extends('layouts.admin')
@section('content')
@foreach(explode(',', $_GET['productimage']) as $image)
<img src="{{asset($image)}}" />
@endforeach
@stop
