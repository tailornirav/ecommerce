@extends('layouts.admin')
@section('content')
<div>
    <h1>Shipping charge</h1>
    <form method="get" action="/updateshipping">
        <input min="0" type="number" name="shipping" value={{$shipping->charge}} />
        <input type="submit" value="Update" />
    </form>
</div>
@stop
