@extends('admin.layout')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="container mt-2">
    <div class="row">

    
        <div class="col-md-12 card-header text-center font-weight-bold">
          <h2>All Products</h2>
        </div>
        <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewBook" class="btn btn-success">Add</button></div>
        <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">product Description</th>
                  {{-- <th scope="col">Image</th> --}}
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody> 
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    {{-- <td>{{ $product->author }}</td> --}}
                    <td>
                       <a href="javascript:void(0)" class="btn btn-info edit" data-id="{{ $product->id }}">Edit</a>
                      <a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $product->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
             {!! $products->links() !!}
        </div>
    </div>        
</div>
<!-- boostrap model -->
    <div class="modal fade" id="ajax-book-model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ajaxBookModel"></h4>
          </div>
          <div class="modal-body">
            <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" class="form-horizontal" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="id" id="id"  value="111">
              
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Name(English)</label>
                    <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Name(english)">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Name(Arabic)</label>
                    <input type="text" class="form-control"  name="name_ar" id="name_ar" placeholder="Name(Arabic)">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Description(English)</label>
                    <input type="text" class="form-control" name="des_en" id="des_en" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Description(Arabic)</label>
                    <input type="text" class="form-control" name="des_ar" id="des_ar" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Price</label>
                    <input type="number"  name="price" id="price" class="form-control" id="price" placeholder="price">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputState">Status</label>
                    <select id="status"  name="status" class="form-control">
                      <option selected>Choose...</option>
                      <option  value="1">Active</option>
                      <option value="0">Unactive</option>
                    </select>
                  </div>
                </div>
              {{-- <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Product Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="title" name="name" placeholder="Enter Book Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Product Description</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="code" name="description" placeholder="Enter Book Code" value="" maxlength="50" required="">
              </div> --}}
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-12">
                  @php
                       $category=App\Models\Category ::all()
                  @endphp
                  <select class="form-control"   id="category" name="category">
                      
                    @foreach ($category as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}/option>
                    @endforeach
                  </select>
              </div>
              </div>
              <div class="form-group"id="hidedev">
                <label class="col-sm-2 control-label">Upload Image</label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" id="image" name="image" placeholder="Enter author Name" value="" required="">
                </div>
              </div>
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
<!-- end bootstrap model -->


<script type="text/javascript">
 $(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addNewBook').click(function () {
       $('#addEditBookForm').trigger("reset");
       $('#ajaxBookModel').html("Add Book");
       $('#ajax-book-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('edit-product') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("Edit Book");
              $('#ajax-book-model').modal('show');
              $('#id').val(res.id);
              $('#title').val(res.name);
              $('#code').val(res.description);
              // $('#author').val(res.image);
           }
        });
    });
    $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
          
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('delete-product') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              window.location.reload();
           }
        });
       }
    });
    $('body').on('click', '#btn-save', function (event) {
          var id = $("#id").val();
          var name_en = $("#name_en").val();
          var name_ar = $("#name_ar").val();
          var des_en = $("#des_en").val();
          var des_ar = $("#des_ar").val();
          var status = $("#status").val();
          var price = $("#price").val();
          var category = $("#category").val();
          var image = $("#image").val();
          var code = $("#code").val();
          var author = $("#author").val();
          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('product/store') }}",
            data: {
              id:id,
              name_en:name_en,
              name_ar:name_ar,
              des_en:des_en,
              des_ar:des_ar,
              price:price,
              status:status,
              category:category,
              image:image,
              // code:code,
              // author:author,
            },
            dataType: 'json',
            success: function(res){
             window.location.reload();
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
           }
        });
    });
});
</script>


<script>
  $(document).ready(function(){
    $(".edit").click(function(){
      $("#hidedev").remove();
    });
  });
  </script>
@endsection
@include('category.toster')