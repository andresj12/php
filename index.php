<?php

// Path de uploaded files
$target_path = dirname(__FILE__).'/uploads/';
  
if (isset($_FILES['image']['name'])) {
    // $target_path = $target_path . basename($_FILES['image']['name']);//nombre de la imagen
    $target_path = $target_path . 'image.jpg';
 
    try {
        // Throws exception si la imagen no se subio
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            
  
            $ch = curl_init('https://api.clarifai.com/v2/models/' . 'flores'. '/outputs'); 

             $key = '68817275177a4699a4c70263e5b6fcfc';
            // $key = 'd6a51f0e10bb42b283e39037ac84f7c1';
             

            $ar =	array("inputs" => array("data" => array("image" => array("url" => "https://reconocimiento.herokuapp.com/uploads/image.jpg"))));
            $data=  '{
                "inputs": [
                    {
                "data": {
                "image": {
                    "url": "https://reconocimiento.herokuapp.com/uploads/image.jpg"
                            }
                        }
                    }
                            ]
            }';

	    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
       		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		    curl_setopt($ch, CURLOPT_HTTPHEADER, array(               
            "Authorization: Key $key",                                                                                
            "Content-Type: application/json")                                                                       
            );      
            $output = curl_exec($ch); 
            curl_close($ch);  
    
 	     $output = json_decode($output, true);

            // $response = $output['outputs'][0]['data']['concepts'];
            $response = $output;
//['concepts']
            //curl_close ($ch);
            echo json_encode(array('status'=>'success', 'values' => $response));
            
		//echo  json_decode($output, TRUE);
		//var_dump($output);
//		echo $output;
            
            
        } else {
            // make error flag true
            echo json_encode(array('status'=>'fail', 'message'=>'could not move file'));

         
       }
 
  } catch (Exception $e) {
        // Exception occurred. Make error flag true
        echo json_encode(array('status'=>'fail', 'message'=>$e->getMessage()));
  }
} else {
    // File parameter is missing
    echo json_encode(array('status'=>'fail', 'message'=>'Not received any file'));
}


?>
