<?php
    
    //session_start();
    function cartItem($gname, $gpublisher, $ggenre, $gprice, $gid){
        $ele = "
                <form action='cart.php?action=remove&id=$gid' method='post'>
                <div class='cart-item'>
                <p>Game: $gname</p>
                <p>Publisher: $gpublisher</p>
                <p>Genre: $ggenre</p>
                <p>Price: $gprice</p>
                <button type='submit' name='remove'>Remove</button>
                </div>
                </form>
                <br>";
        echo $ele;
    }
    
    function profileRecord($gname, $ggenre, $gprice){
        $ele = "
                <div class='order'>
                <p>Game: $gname</p>
                <p>Game Genre: $ggenre</p>
                <p>Game Amount: $gprice</p>
                <br>";

        echo $ele;
    }

    //function total