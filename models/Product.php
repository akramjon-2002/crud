<?php

namespace models;

use connection\Connection;
use myFunction\Model;
use constant\Constant;
use PDO;
use PDOException;

class Product extends Model
{
public function tablename(){
    return "products";
}


    public function getById($id){
        $sql = "select * from `products` where id = :id";
        $data = $this->db->prepare($sql);
        $data->bindParam(":id", $id);
        $data->execute();
        return $data->fetch(PDO::FETCH_OBJ);

    }

    public function getPageCount()
    {

        $count_sql = "SELECT * FROM `products`";
        $count_pr = $this->db->prepare($count_sql);
        $count_pr->execute();
        $totalCount = $count_pr->rowCount();
        return ceil($totalCount / Constant::LIMIT);
    }



    public function addProduct($name, $description, $price, $imagePath) {
        try {
            $sql = "INSERT INTO `products` (product_name, description, price, image, added_at) VALUES (:product_name, :description, :price, :image_path, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':product_name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image_path', $imagePath);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                die("Error while inserting data: " . $stmt->errorInfo()[2]);
            }

            echo "The data was successfully inserted into the database";
            header("Location: /product/list");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }





    public function updateProduct($id, $name, $description, $price, $photo)
    {
        try {
            $sql = "UPDATE `products` SET product_name = :name, description = :description, price = :price, image = :photo, added_at = NOW() WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':photo', $photo);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                die("Error while updating data: " . $stmt->errorInfo()[2]);
            }

            echo "The data was successfully updated in the database";
            header("Location: /product/list");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function deleteProduct($id)
    {
        try {
            $sql = "DELETE FROM `products` WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                die("Error while deleting data: " . $stmt->errorInfo()[2]);
            }

            echo "The data was successfully deleted from the database";
            header("Location: /product/list");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getList($page, $withoutLimit = false){
        $offset = ($page-1) * Constant::LIMIT;
        if ($withoutLimit) {
            $sql = "select * from `products`";
            $state = $this->db->prepare($sql);
        }else{
            $sql = "select * from `products` limit :offset, :limit";
            $state = $this->db->prepare($sql);
            $state->bindValue(":limit", Constant::LIMIT, PDO::PARAM_INT);
            $state->bindValue(":offset", $offset, PDO::PARAM_INT);
        }
        $state->execute();
        $result = $state->fetchAll(PDO::FETCH_OBJ);
        return $result;

    }






}