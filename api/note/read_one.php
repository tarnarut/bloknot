<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/note.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare note object
$note = new Note($db);
 
// set ID property of record to read
$note->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of note to be edited
$note->readOne();
 
if($note->name!=null){
    // create array
    $note_arr = array(
        "id" =>  $note->id,
        "name" => $note->name,
        "text" => $note->text,
        "category_id" => $note->category_id,
        "category_name" => $note->category_name
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($note_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user note does not exist
    echo json_encode(array("message" => "Note does not exist."));
}
?>