<?php
function sendJsonResponse($data=[], $message = "Successfully", $status_code = 200){
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json;  charset=utf-8");
    http_response_code($status_code);
    echo json_encode([
            "data"=>$data,
            "message"=> $message     
            ],
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );
    exit();
}
function sendErrorResponse($message="Fail", $status_code =422){
    http_response_code($status_code);
    echo json_encode([
            "message"=> $message,
            "error"=>1
            ],
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );
    exit();
}