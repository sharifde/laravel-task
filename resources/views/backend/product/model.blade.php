<!-- boostrap add and edit book model -->
<div class="modal fade" id="ajax-book-model" aria-hidden="true">
    <div class="modal-dialog ">
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
                  <input type="text" class="form-control" name="name_en" id="name_en" required placeholder="Name(english)">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Name(Arabic)</label>
                  <input type="text" class="form-control"  name="name_ar" id="name_ar" required placeholder="Name(Arabic)">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Description(English)</label>
                  <input type="text" class="form-control" name="des_en" id="des_en" required placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Description(Arabic)</label>
                  <input type="text" class="form-control" name="des_ar" id="des_ar" required placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Price</label>
                  <input type="number"  name="price" id="price" class="form-control" id="price" required placeholder="price">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputState">Status</label>
                  <select id="status"  name="status" class="form-control">
                    <option selected>Choose...</option>
                    <option  value="1">Active</option>
                    <option value="0">Inactive</option>
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
              <label for="name" class="col-sm-10 control-label">Choose Category</label>
              <div class="col-sm-12">
                @php
                     $category=App\Models\Category ::all()
                @endphp
                <select class="form-control"   id="category" name="category">
                    
                  @foreach ($category as $cat)
                  
                  <option value="{{$cat->id}}">{{$cat->name_en}}</option>
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