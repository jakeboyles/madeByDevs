<?

class MY_Upload extends CI_Upload {


public function multiFileUpload($path, $protect = FALSE){

  /*
  * Declare uploaded_info and uploaded_files
  * when i'm sure $_FILES has some data
  */
 /* if($this->upload_path[strlen($this->upload_path)-1] != '/')
   $this->upload_path .= '/';*/

   //$this->upload_path=$path;

  if(isset($_FILES)){

   #Here we check if the path exists if not then create
   /*if(!file_exists($this->upload_path)){
    @mkdir($this->upload_path,0700,TRUE);
   }*/

    if(!file_exists($path)){
    @mkdir($path,0700,TRUE);
   }  
    $uploaded_info  = FALSE;
    /*
    * The structure of $_FILES changes a lot with the array name on the input file,
    * then i'm gonna modify $_FILES to make it think the data comes from several
    * input file instead of one "arrayfied" input.
    *
    * The several ways to upload files are controled with this if...else structure
    */
    if(count($_FILES) == 1)
    {
        $main_key = key($_FILES);
        if(is_array($_FILES[$main_key]['name']))
        {

            foreach($_FILES[$main_key] as $key => $value)
            {                

                for($y = 0; $y < count($value); $y++)
                {

                    $_FILES[$main_key .'-'. $y][$key] = $value[$y];

                }


            }

            unset($_FILES[$main_key]);

            $uploaded_files  = $_FILES;
        }
        else
        {
            $uploaded_files  = $_FILES;    
        }

    }
    else
    {
        $uploaded_files  = $_FILES;    
    }

   #Here we create the index file in each path's directory
   /*if($protect){
    $folder = '';
    foreach(explode('/',$this->upload_path)  as $f){

     $folder .= $f.'/';
     $text = "<?php echo 'Directory access is forbidden.'; ?>";

     if(!file_exists($folder.'index.php')){
      $index = $folder.'index.php'; 
      $Handle = fopen($index, 'w');
      fwrite($Handle, trim($text));
      fclose($Handle); 
     }
    }   
   }*/

   #Here we do the upload process

   foreach($uploaded_files as $file => $value){
    if (!$this->do_upload($file))
    {
     $uploaded_info['error'][]  =  array_merge($this->data(),
              array('error_msg' => $this->display_errors()));

    }
    else
    {
     $uploaded_info['upload_data'][] =  array_merge($this->data(),
              array('error_msg' => $this->display_errors()));
    }
   }  
  }

  #Then return what happened with the files
  return $uploaded_info;
 } 
}