<?php
	function show_dialog($msg){
		echo $msg;
	}

	function deep_in_array($value, $array) { 
	    foreach($array as $item) {   
	        if(!is_array($item)) {   
	            if ($item == $value) {  
	                return true;  
	            } else {  
	                continue;   
	            }  
	        }   
	           
	        if(in_array($value, $item)) {  
	            return true;      
	        } else if(deep_in_array($value, $item)) {  
	            return true;      
	        }  
	    }   
	    return false;
	}
	


?>