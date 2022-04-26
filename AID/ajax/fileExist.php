<?php

    $file = $_GET['file'];

    if(file_exists($file)){

        echo json_encode(1);

    }else{

        echo json_encode(0);

    }