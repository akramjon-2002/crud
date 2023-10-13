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
                    echo "Недопустимый формат изображения. Пожалуйста, выберите файл в формате jpg, jpeg или png.";
                } elseif ($image['size'] < 10000 || $image['size'] > 1000000) {
                    echo "Размер файла должен быть от 10 Kb до 1 Mb.";
                } elseif (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                    $product = new Product();
                    $product->addProduct($name, $description, $price, $uploadPath);
                } else {
                    echo "Ошибка при загрузке файла.";
                }
            } else {
                echo "Пожалуйста, выберите файл изображения.";
            }
        }
        $this->view->render('product/create');
    }




    public function update($id)
    {
        $productModel = new Product();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $photo = null;

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    $photo = $uploadFile;
                }
            }

            $productModel->updateProduct($id, $name, $description, $price, $photo);
        }

        $product = $productModel->getById($id);
        $this->view->render('product/update', ['product' => $product]);

    }



    public function delete($id)
    {
        $productModel = new Product();
        $productModel->deleteProduct($id);
    }
}
