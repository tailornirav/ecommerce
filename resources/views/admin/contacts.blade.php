@extends('layouts.admin')
@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Contact <b>Details</b></h2>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="50">Name</th>
                    <th width="65">Email</th>
                    <th width="45">Mobile</th>
                    <th width="60">Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact -> name }}</td>
                    <td>{{ $contact -> email }}</td>
                    <td>{{ $contact -> phone }}</td>
                    <td>{{ $contact -> subject }}</td>
                    <td>{{ $contact -> message }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
