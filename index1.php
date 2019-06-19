<?php
$ch = curl_init('https://api.clarifai.com/v2/models/' . 'flores'. '/outputs'); 

             $key = '68817275177a4699a4c70263e5b6fcfc';
            // $key = 'd6a51f0e10bb42b283e39037ac84f7c1';
             

            $ar =	array("inputs" => array("data" => array("image" => array("url" => "http://192.168.1.3:8080/Mineria/uploads/image.jpg"))));
            $data=  '{
                "inputs": [
                    {
                "data": {
                "image": {
                    "url": "http://192.168.1.3:8080/Mineria/uploads/image.jpg"
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
    ?>        