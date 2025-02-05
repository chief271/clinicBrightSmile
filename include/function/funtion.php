<?php

    function GetTitle(){
        global $pagetitle;
        if(isset($pagetitle)){
            echo $pagetitle;
        }else{
            echo 'default';
        }
    }    

?><?php

