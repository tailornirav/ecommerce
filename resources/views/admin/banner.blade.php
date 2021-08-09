@extends('layouts.admin')
@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Banner <b>Details</b></h2>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Discription</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr>
                    <td>{{ $banner -> name }}</td>
                    <td><a href='{{ asset($banner -> image)}}'> View</a></td>
                    <td>{{ $banner -> discription }}</td>
                    <td>{{ $banner -> url }}</td>
                    <td>
                        <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                        <a href="/deletebanner/{{ $banner -> id}}" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(".add-new").click(function() {
            $(this).attr("disabled", "disabled");
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
                '<td><input type="text" class="form-control" name="name" id="name"></td>' +
                '<td><input type="file" class="form-control" name="file" id="file"></td>' +
                '<td><input type="text" class="form-control" name="discription" id="discription"></td>' +
                '<td><input type="text" class="form-control" name="url" id="url"></td>' +
                '<td>' +
                '<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>' +
                '</td>' +
                '</tr>';
            $("table").append(row);
            $("table tbody tr").eq(index + 1).find(".add").toggle();
            $('[data-toggle="tooltip"]').tooltip();
        });
        // Add row on add button click
        $(document).on("click", ".add", function() {
            var formData = new FormData();
            formData.append("name", document.getElementById('name').value);
            formData.append("file", document.getElementById('file').files[0]);
            formData.append("discription", document.getElementById('discription').value);
            formData.append("url", document.getElementById('url').value);

            $.ajax({
                type: "post",
                url: '/addbanner',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    location.reload();
                }
            });
        });
    });
</script>
@stop
