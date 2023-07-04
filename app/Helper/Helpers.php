<?php

function jsonResponse($status,$message,$status_code){
    return response()->json([
'status'=>$status,
'message'=>$message
],$status_code);
}


?>