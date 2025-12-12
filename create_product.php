<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new product</title>
    <?php include("html/style.php");?>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("html/aside.php");?>
                <main class="col">
                    <h1>Create a new product</h1>
                    <form action="/save_product.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Product name</label>
                            <input type="text" name="name" class="form-control" placeholder="Product name...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                              <input type="text" name="price" class="form-control" placeholder="Price...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                              <input type="text" name="thumbnail" class="form-control" placeholder="Image...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Qty</label>
                            <input type="text" name="qty" class="form-control" placeholder="Qty...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                              <input type="text" name="description" class="form-control" placeholder="Description...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category_id</label>
                              <input type="text" name="category_id" class="form-control" placeholder="Category_id...">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </main>
            </div>
        </div>
    </section>
</body>
</html>
