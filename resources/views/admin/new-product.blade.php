@extends('layouts.admin')
@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
<form onsubmit="onsubmitfn();">
    <input type="hidden" value="{{$product->id ?? -1}}" id="id"/>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h2>Products</h2>
                                </div>
                            </div>
                            <div class="row product-form">
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Name</label>
                                        <input type="text" required="" id="name" value="{{$product->name ?? ''}}" >
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Price</label>
                                        <input type="number" required="" id="prize" value="{{$product->prize ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Final Price</label>
                                        <input type="number" required="" id="finalPrize" value="{{$product->finalPrize ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Stock</label>
                                        <input type="number" required="" id="availability" value="{{$product->availability ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Brand</label>
                                        <input type="text" required="" id="brand" value="{{$product->brand ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Season</label>
                                        <input type="text" required="" id="season" value="{{$product->season ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Color</label>
                                        <input type="text" required="" id="color" value="{{$product->color ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Meter</label>
                                        <input type="text" required="" id="fit" value="{{$product->fit ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-box">
                                        <label>Size</label>
                                        <input type="text" required="" id="size" value="{{$product->size ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-box">
                                        <label>Image</label>
                                        <input type="file" id="file" multiple>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-box">
                                        <label>Category</label>
                                        <select name="category" id="category">
                                            <option value="sarees" @if(($product->category ?? null) === "sarees") selected @endif>SAREES</option>
                                            <option value="kurties"  @if(($product->category ?? null) === "kurties") selected @endif>KURTIES</option>
                                            <option value="salwar"  @if(($product->category ?? null) === "salwar") selected @endif>SALWAR</option>
                                            <option value="lehengas" @if(($product->category ?? null) === "lehengas") selected @endif>LEHENGAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-box">
                                        <label>Discription</label>
                                        <textarea required="" id='discription' name="discription" rows="10">{{$product->discription ?? ''}}</textarea>
                                    </div>
                                    <script>CKEDITOR.replace( 'discription' );</script>
                                </div>
                                <div class="col-12">
                                    <input type='submit' class="submit-btn" value='Submit' / >
                                </div>
                            </div>
                            </form>
                            </div>
                            </div>
                         <script>
        function onsubmitfn() {
            event.preventDefault();
            var formData = new FormData();
            var ins = document.getElementById('file').files.length;
            for (var x = 0; x < ins; x++) {
                formData.append("file[]", document.getElementById('file').files[x]);
            }
            formData.append("id", document.getElementById('id').value);
            formData.append("name", document.getElementById('name').value);
            formData.append("prize", document.getElementById('prize').value);
            formData.append("finalPrize", document.getElementById('finalPrize').value);
            formData.append("availability", document.getElementById('availability').value);
            formData.append("discription", CKEDITOR.instances.discription.getData());
            formData.append("brand", document.getElementById('brand').value);
            formData.append("season", document.getElementById('season').value);
            formData.append("color", document.getElementById('color').value);
            formData.append("fit", document.getElementById('fit').value);
            formData.append("size", document.getElementById('size').value);
            formData.append("category", document.getElementById('category').value);
            formData.append("count", ins);
            $.ajax({
                type: "post",
                url: '/addproduct',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function() {
                    window.location.assign("/admin/product");
                }
            });
        }
</script>
@stop