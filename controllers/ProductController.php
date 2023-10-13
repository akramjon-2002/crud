<?php

namespace controllers;

use constant\Constant;
use models\Product;
use myFunction\Controller;

class ProductController extends Controller
{
    public function list($page = 1)
    {
        $product = new Product;
        $result = $product->getList($page);
        $pageCount = $product->getPageCount();
        $this->view->render("product/list", ['list' => $result, 'pageCount' => $pageCount, 'currentPage' => $page]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'] ?? 0;
            $image = $_FILES['photo'];

            if ($image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadPath = $uploadDir . $image['name'];

                $allowedFormats = ['jpg', 'jpeg', 'png'];
                $fileExtension = strtolower(pathinfo($uploadPath, PATHINFO_EXTENSION));
                if (!in_array($fileExtension, $allowedFormats)) {
                    echo "Invalid image format. Please select a jpg, jpeg or png file.";
                } elseif ($image['size'] < 10000 || $image['size'] > 1000000) {
                    echo "The file size must be from 10 Kb to 1 Mb";
                } elseif (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                    $product = new Product();
                    $product->addProduct($name, $description, $price, $uploadPath);
                } else {
                    echo "error download photo";
                }
            } else {
                echo "please choose file photo";
            }
        }
        $this->view->render('product/create');
    }




    public function update($id)
    {
        $productModel = new Product();
        $product = $productModel->getById($id);
        $photo = $product->image;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    $photo = $uploadFile;
                } else {
                    echo "Error loading file";
                }
            }

            $productModel->updateProduct($id, $name, $description, $price, $photo);
        }

        $this->view->render('product/update', ['product' => $product]);
    }




    public function delete($id)
    {
        $productModel = new Product();
        $productModel->deleteProduct($id);
    }
}
