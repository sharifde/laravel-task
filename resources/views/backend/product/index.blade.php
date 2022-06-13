@extends('backend.partial.layout')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<div class="container mt-2">
  <div class="container ">
  
    <div class="col-md-12 mt-1 mb-2   pt-3"><button type="button" id="addNewBook" class="btn btn-success">Add</button></div>
    <div class="col-md-12">
      <table class="table   table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name(English)</th>
            <th scope="col">Name(Arabic)</th>
            <th scope="col">Des(English)</th>
            <th scope="col">Des(Arbic)</th>
            <th scope="col">Status</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody> 
          @foreach ($products as $product)
          <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name_en }}</td>
              <td>{{ $product->name_ar }}</td>
              <td>{{ $product->des_en }}</td>
              <td>{{ $product->des_ar }}</td>
              <td>
                @if($product->status =='1')         
                   <p  class="text-success text-bold">Active</p>         
                 @else
                  <p class="text-info text-bold"> Inactive </p>        
                 @endif
              </td>
              <td>
                <img src="{{asset('storage/'.$product->image)}}" width="65" height="65"  style=" border-radius: 50%;" alt=" image not found">

              </td>

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
    @include('backend.product.model')
  <script type="text/javascript">
       
   $(document).ready( function () {
      $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#image').change(function(){
             
      let reader = new FileReader();
      reader.onload = (e) => { 
        $('#preview-image').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]); 
    
     });
      $('#datatable-ajax-crud').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{ url('ajax-datatable-crud') }}",
             columns: [
                      {data: 'id', name: 'id', 'visible': false},
                      { data: 'image', name: 'image' , orderable: false},
                      { data: 'title', name: 'title' },
                      { data: 'code', name: 'code' },
                      { data: 'author', name: 'author' },
                      { data: 'created_at', name: 'created_at' },
                      {data: 'action', name: 'action', orderable: false},
                   ],
            order: [[0, 'desc']]
      });
      $('#addNewBook').click(function () {
         $('#addEditBookForm').trigger("reset");
         $('#ajaxBookModel').html("Add Product");
         $('#ajax-book-model').modal('show');
         $("#image").attr("required", "true");
         $('#id').val('');
         $('#preview-image').attr('src', 'https://www.riobeauty.co.uk/images/product_image_not_found.gif');
      });
   
      $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        var url = '{{route("products.edit", ":id")}}';
        url = url.replace(':id', id);
           
          // ajax
          $.ajax({
              type:"get",
              url: url,
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
                $('#price').val(res.price);
                $('#status').val(res.status);
                // $('#image').attr('res.src'); 
                $('#image').removeAttr('required');
             }
          });
      });
      $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
          
        // ajax
        $.ajax({
            type:"delete",
            url: "{{ route('products.store') }}"+'/'+id,
            data: { id: id },
            dataType: 'json',
            success: function(res){
              window.location.reload();
           }
        });
       }
      });
     $('#addEditBookForm').submit(function(e) {
       e.preventDefault();
    
       var formData = new FormData(this);
    
       $.ajax({
          type:'POST',
          url: "{{ route('products.store')}}",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {
            $("#ajax-book-model").modal('hide');
            var oTable = $('#datatable-ajax-crud').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
            window.location.reload();

            
          },
          error: function(data){
             console.log(data);
           }
         });
     });
  });
  </script>
  <style>
    .main-footer{display: none}
  </style>
@endsection
@include('layouts.backend.toster')