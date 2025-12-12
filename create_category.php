<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new category</title>
    <?php include("html/style.php");?>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <?php include("html/aside.php");?>
                <main class="col">
                    <h1>Create a new category</h1>
                    <form action="/save_category.php" method="post" enctype="multipart/form-data">
                        <!-- multipart để gủi file kèm lên -->
                        <div class="mb-3">
                            <label class="form-label">Category name</label>
                            <input type="text" name="name" class="form-control" placeholder="Category name ...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="Category slug ...">
                        </div>
                         <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="file" name="icon" class="form-control" placeholder="Category icon ...">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </main>
            </div>
        </div>
    </section>
</body>
</html>

