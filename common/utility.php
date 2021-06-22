<?php
function pagination($number, $page, $addition) {
    
    if($number > 1) {
        echo '<ul class="pagination">';

        if($page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page='.($page - 1).$addition.'">Previous</a></li>';
        }


        $availablePage = [1, $page - 1, $page, $page + 1, $number];
        $isFirst = $isLast = false;
        for($i = 1; $i <= $number; $i++) {
            if(!in_array($i, $availablePage)) {
                if(!$isFirst && $i < $page) {
                    echo ' <li class="page-item"><a class="page-link" href="?page='.($page-2).$addition.'">...</a></li>';
                    $isFirst = true;
                }
                if(!$isLast && $i > $page) {
                    echo ' <li class="page-item"><a class="page-link" href="?page='.($page+2).$addition.'">...</a></li>';
                    $isLast = true;
                }
                continue;
            }

            if($page == $i) {
                echo ' <li class="page-item active"><a class="page-link" href="?page='.$i.$addition.'">'.$i.'</a></li>';
            } else {
                echo ' <li class="page-item"><a class="page-link" href="?page='.$i.$addition.'">'.$i.'</a></li>';
            }
        }


        if($page < $number) {
            echo '<li class="page-item"><a class="page-link" href="?page='.($page + 1).$addition.'">Next</a></li>';
        }

        echo '</ul>';

    }
}

?>


