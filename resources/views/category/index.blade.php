@extends('admin.layout')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="container mt-2">
 
    <div class="row">
        <div class="col-md-12 card-header text-center font-weight-bold">
          <h2>All Categories</h2>
        </div>
        <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewBook" class="btn btn-success">Add</button></div>
        <div class="col-md-12">
            <table class="table  table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name(English)</th>
                  <th scope="col">Name(Arabic)</th>
                  <th scope="col">Desc(English)</th>
                  <th scope="col">Desc(Arabic)</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody> 
                @foreach ($categries as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name_en }}</td>
                    <td>{{ $category->name_ar }}</td>
                    <td>{{ $category->des_en }}</td>
                    <td>{{ $category->des_ar }}</td>
                    <td>
                      @if($category->status =='1')         
                         <p  class="text-success text-bold">Active</p>         
                       @else
                        <p class="text-info text-bold"> Unactive </p>        
                       @endif
                    </td>
                    {{-- <td>{{ $category->author }}</td> --}}
                    <td>
                       <a href="javascript:void(0)" class="btn btn-info edit" data-id="{{ $category->id }}">Edit</a>
                      <a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $category->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
             {!! $categries->links() !!}
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
            <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" class="form-horizontal" method="post">
                <input type="hidden" name="id" id="id"  value="">
 
                   
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Name(English)</label>
                    <input type="text" class="form-control" name="name_en" id="name_en" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Name(Arabic)</label>
                    <input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Description(English)</label>
                    <input type="text" class="form-control" name="des_en" id="des_en" placeholder="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Description(Arabic)</label>
                    <input type="text" class="form-control" name="des_ar" id="des_ar" placeholder="">
                  </div>
                
                </div>
                <div class="form-group col-md-12">
                  <label for="inputState">Status</label>
                  <select id="status"  name="status" class="form-control">
                    <option selected>Choose...</option>
                    <option  value="1">Active</option>
                    <option value="0">Unactive</option>
                  </select>
                </div>
                

              {{-- <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Book Name" value="" maxlength="50" required="">
                </div>
              </div>  
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Category Description</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="code" name="code" placeholder="Enter Book Code" value="" maxlength="50" required="">
                </div>
              </div> --}}
              {{-- <div class="form-group">
                <label class="col-sm-2 control-label">Book Author</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="author" name="author" placeholder="Enter author Name" value="" required="">
                </div>
              </div> --}}
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
            url: "{{ url('edit-book') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("Edit Book");
              $('#ajax-book-model').modal('show');
              $('#id').val(res.id);
              $('#name_en').val(res.name_en);
              $('#name_ar').val(res.name_ar);
              $('#des_en').val(res.des_en);
              $('#des_ar').val(res.des_ar);
              $('#status').val(res.status);
              // $('#author').val(res.author);
           }
        });
    });
    $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('delete-book') }}",
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
          // var author = $("#author").val();
          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('add-update-book') }}",
            data: {
              id:id,
              name_en:name_en,
              name_ar:name_ar,
              des_en:des_en,
              des_ar:des_ar,
              status:status,
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
@include('category.toster')
@endsection