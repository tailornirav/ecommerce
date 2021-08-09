@extends('layouts.admin')
@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Product <b>Details</b></h2>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="70px">No.</th>
                    <th>Name</th>
                    <th width="70px">Image</th>
                    <th width="70px">Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1;?>
                @foreach($products as $product)
                <tr>
                    <td><?php echo $counter; $counter += 1;?></td>
                    <td>{{ $product -> name}}</td>
                    <td><a href="/admin/productimage?productimage={{$product->images}}">View</a></td>
                    <td>{{ $product -> availability}}</td>
                    <td>
                        <a href="/admin/addproductform/{{$product->id}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        <a href="/deleteproduct/{{$product->id}}" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
