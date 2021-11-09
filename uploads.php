<?php 

    $valid_extensions = array("jpg","jpeg","png");

    if (!empty(array_filter($_FILES['file']['name']))) {

        foreach($_FILES['file']['name'] as $id=>$val) {

            $location = "assets/images/" . $_FILES['file']['name'][$id];
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);

            if(in_array($imageFileType, $valid_extensions)) {
                if(move_uploaded_file($_FILES['file']['tmp_name'][$id], $location)) {
                    $sqlVal = "('".$_FILES['file']['name'][$id]."', '".$_FILES['hair_dressor_id']."')";
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "File coud not be uploaded."
                    );
                }
            } else {
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Only .jpg, .jpeg and .png file formats allowed."
                );
            }

            if(!empty($sqlVal)) {
                $insert = $conn->query("INSERT INTO work_hair_dressor (images, hair_dressor_id) VALUES $sqlVal");
                if($insert) {
                    $response = array(
                        "status" => "alert-success",
                        "message" => "Files successfully uploaded."
                    );
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Files coudn't be uploaded due to database error."
                    );
                }
            }
        }
    } else {
        // Error
        $response = array(
            "status" => "alert-danger",
            "message" => "Please select a file to upload."
        );
    }