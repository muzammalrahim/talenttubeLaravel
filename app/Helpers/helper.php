<?php

function checkRole($roles){
    echo "test helper working ";
}

function isAdmin(){
    $user = Auth::user();
    return ( $user )?($user->isAdmin()):false;
}



