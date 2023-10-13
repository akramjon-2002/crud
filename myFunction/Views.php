<?php

namespace myFunction;

class Views
{

    function render($viewFile, $data = null)
    {
        if (!is_null($data)) {
            extract($data);
        }
        include "view/layouts/header.php";
        include "view/" . $viewFile . ".php";
        include "view/layouts/footer.php";

    }

}