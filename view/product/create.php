<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/product/create" method="POST" enctype="multipart/form-data" form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Product Description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Product Price" required>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>


                <button type="submit" class="btn btn-success">Add Product</button>
            </form>
        </div>
    </div>
</div>

