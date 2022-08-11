<?php
        //add
function add_item(string $content){
            // сюда содержимое файла
if (!file_exists("./php-calls.json")) { 
    $arr = array();
    $string = json_encode($arr);
    file_put_contents("./php-calls.json",$string);
}

$file = file_get_contents("./php-calls.json");

$data = json_decode($file);

$data[] = ['id'=> uniqid(""), 'content' => $content,'timestump'=> date("20-12-2000")];

$data = json_encode($data, JSON_PRETTY_PRINT);

file_put_contents("./php-calls.json",$data);  
        };

        //update
function update_item(string $id,string $content){
        
        if (!file_exists("./php-calls.json")) { 
                $arr = array();
                $string = json_encode($arr);
                file_put_contents("./php-calls.json",$string);
         }
        
        $file = file_get_contents("./php-calls.json");
        $data = json_decode($file, true);
        
        $current = $id;
        foreach ( $data as $key => $value){   
        
           if ($value['id'] === $current) {          
            $data[$key]['content'] = $content;
           }
        } 
        
        $data = json_encode($data, JSON_PRETTY_PRINT);
        
        file_put_contents("./php-calls.json",$data);
    };

                //delete
                function delete_item($content){
    
    if (!file_exists("./php-calls.json")) { 
            $arr = array();
            $string = json_encode($arr);
            file_put_contents("./php-calls.json",$string);
     }
    
    $file = file_get_contents("./php-calls.json");
    
    $data = json_decode($file, true);
    $current = $content;
    foreach ( $data as $key => $value){      
    
       if ($value['id'] === $current) {          
    
        unset($data[$key]);        
       }
     } 
        
    $data = json_encode($data, JSON_PRETTY_PRINT);
    
    file_put_contents("./php-calls.json",$data);
    };


            //read
            function read_item(){
            if (!file_exists("./php-calls.json")) { 
                $arr = array();
                $string = json_encode($arr);
                file_put_contents("./php-calls.json",$string);
         }
        
        $file = file_get_contents("./php-calls.json");
        
        $data = json_decode($file);
        
        $data = json_encode($data, JSON_PRETTY_PRINT);
        
        file_put_contents("./php-calls.json",$data);
        print_r($data);
            };
        

?>