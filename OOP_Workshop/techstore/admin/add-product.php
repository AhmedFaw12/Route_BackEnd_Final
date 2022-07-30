<?php  require_once("inc/header.php");?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Product</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form>
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control">
                                  <option>one</option>
                                  <option>two</option>
                                  <option>three</option>
                                </select>
                            </div>
                            

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Pieces</label>
                                <input type="number" class="form-control">
                            </div>
  
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                              
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php  require_once("inc/footer.php");?>