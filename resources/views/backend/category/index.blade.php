@extends('backend.partial.layout')
@section('content')
<div class="container mt-2">
   <ul>
   
   </ul>
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
                        <p class="text-info text-bold"> Inactive </p>        
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
@include('backend.category.model')
<script type="text/javascript">
 $(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addNewBook').click(function () {
       $('#addEditBookForm').trigger("reset");
       $('#ajaxBookModel').html("Add Category");
       $('#ajax-book-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        var url = '{{route("categories.edit", ":id")}}';
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
            type:"delete",
            url: "{{ route('categories.store') }}"+'/'+id,
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
            url: "{{ url('categories') }}",
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
@include('layouts.backend.toster')
@endsection