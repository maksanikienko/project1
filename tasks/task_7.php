<?php
$filePath = "./colors.json";
function get_data_from_json_storage(string $filePath){
            
        $file = file_get_contents($filePath);
        $data = json_decode($file,true);
        
        return $data;
        
      
            };
        print_r(get_data_from_json_storage($filePath))

?>