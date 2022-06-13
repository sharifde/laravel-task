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