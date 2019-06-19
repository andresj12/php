<?php 
require_once 'uploads/vendor/autoload.php';

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

$dropboxKey ="ijgcvjb4unw73iv";
$dropboxSecret ="13tecf456t8jicw";
$dropboxToken="AQ9Q1JqhF2AAAAAAAAAAK03agk0bTIsjjGyYzJ6Vn87ZhiqLNJLS5IEcBfjX5HeN";

$app = new DropboxApp($dropboxKey,$dropboxSecret,$dropboxToken);
$dropbox = new Dropbox($app);

//Si la variable archivo no esta vacia
if(!empty($_FILES)){
    $nombre = image;
    $tempfile = $_FILES['file']['tmp_name'];
    $ext = explode(".",$_FILES['file']['name']);
    $ext = end($ext);
    $nombredropbox = "/" .$nombre . "." .$ext;

   try{
        $file = $dropbox->simpleUpload( $tempfile,$nombredropbox, ['autorename' => true]);
        echo "Archivo subido en dropbox";
        include './clarifai.php';
   }catch(\exception $e){
        print_r($e);
        
   }
}
?>