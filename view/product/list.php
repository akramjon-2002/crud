<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarToggleDemo01">
            <h1>Products</h1>

        </div>
    </div>
</nav>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
    </tr>

  </thead>
  <?php foreach ($list as $key) : ?>

    <tr>
        <td><?php echo $key->id; ?></td>
      <td><?php echo $key->product_name; ?></td>
      <td><?php echo $key->description; ?></td>
      <td><?php echo $key->price; ?></td>
        <td>
            <img src="<?php echo $key->image; ?>" alt="Image" >

        </td>

        <td>
        <a class="btn btn-primary" href="/product/update/<?php echo $key->id; ?>">Update</a>
        <a class="btn btn-danger" href="/product/delete/<?php echo $key->id; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<div class="text-center">
  <a class="btn btn-success" href="/product/create">Create</a>
</div>


<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>">
      <a class="page-link" href="/product/list/<?php echo ($currentPage - 1); ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>


    </li>
    <?php for ($page = 1; $page <= $pageCount; $page++) : ?>
  <li class="page-item <?php echo $page == $currentPage ? 'active' : ''; ?>">
    <a class="page-link" href="/product/list/<?php echo $page; ?>"><?php echo $page; ?></a>
  </li>
<?php endfor; ?>

    <li class="page-item <?php echo $currentPage >= $pageCount ? 'disabled' : ''; ?>">
      <a class="page-link" href="/product/list/<?php echo ($currentPage + 1); ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>

  </ul>
</nav>
