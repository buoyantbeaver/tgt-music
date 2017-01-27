<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
class UPLOAD_FILES
{

  /**
   * Receives the original name of the uploaded file.
   *
   * @var     string
   * @access  private
  **/
  var $name;
 /**
   * New name of the uploaded file.
   *
   * @var     string
   * @access  private
  **/
  var $new_name;  
  /**
   * Receives the type of the uploaded file.
   *
   * @var     string
   * @access  private
  **/    
  var $type;
  
  /**
   * Receives the temporary path and name of the uploaded file.
   *
   * @var     string
   * @access  private
  **/        
  var $tmp_name;

  /**
   * Receives the error of the uploaded file.
   *
   * @var     string
   * @access  private
  **/            
  var $error;
  
  /**
   * Store the size of the uploaded file.
   *
   * @var     string
   * @access  private
  **/            
  var $size;

  /**
   * Keep track of the files successfully uploaded.
   *
   * @var     array
   * @access  private
   * @see     moveFileToDestination()
  **/
  var $succeed_files_track;
  
  /**
   * Keep track of the files which fail the upload.
   *
   * @var     array
   * @access  private
   * @see     moveFileToDestination()
  **/
  var $fail_files_track;

  /**
   * Keep the index of the succeed_files_track array.
   *
   * @var     int
   * @access  private
   * @see     moveFileToDestination()
   **/
  var $succeed_track_index;

  /**
   * Keep the index of the fail_files_track array.
   *
   * @var     int
   * @access  private
   * @see     moveFileToDestination()
   **/
  var $fail_track_index;
  
  /**
   * Receives an array with the supported file extensions and types.
   *
   * @var     array
   * @access  private
   * @see     checkUploadConditions()
   **/    
  var $supported_extensions;

  /**
   * Receives the destination directory for uploaded files.
   *
   * @var     string
   * @access  private
   * @see     checkUploadConditions(),createDiretoryStructure(),moveFileToDestination()
  **/    
  var $dst_dir;

  /**
   * Store the permission for the uploaded file. 
   * Default value is 0444(read only).
   *
   * @var     string
   * @access  private
   * @see     moveFileToDestination()
  **/    
  var $file_perm;

  /**
   * Store the field name of the uploaded file.
   *
   * @var     string
   * @access  private
   * @see     moveFileToDestination()
  **/    
  var $fld_name;

  /**
   * Store the file maximum size allowed in bytes.
   * Default value is 40960 bytes (40 KB).
   *
   * @var     int
   * @access  private
   * @see     checkUploadConditions()
  **/        
  var $max_file_size; //bytes.

  /**
   * Store messages of upload status.
   *
   * @var     array
   * @access  private
   * @see     moveFileToDestination()
  **/            
  var $msg;

  /**
   * Store the error code of upload.
   * It became the index for array msg.
   *
   * @var     int
   * @access  private
  **/            
  var $error_type; // error code.

  /**
   * If TRUE generate a random name to the file else maintain the original name.
   * Default value is TRUE;
   *
   * @var     boolean
   * @access  private
   * @see     moveFileToDestination()
  **/            
  var $randon_name;  

  /**
   * If TRUE replace a existent file, else mantain the original file.
   * Default value is TRUE;
   *
   * @var     boolean
   * @access  private
   * @see     moveFileToDestination()
  **/            
  var $replace;  

///////////////////////////////////////////////////////////////////
  /**
   * Constructor
   *
   * @access  public
  **/
  function UPLOAD_FILES(){

    $this->name                 = "";
	$this->new_name				= $this->name;
    $this->type                 = "";
    $this->tmp_name             = "";
    $this->error                = "";
    $this->size                 = "";
    $this->supported_extensions = array();
    $this->dst_dir              = "";
    $this->file_perm            = "0755";
    $this->fld_name             = "";
    $this->max_file_size        = 40960; //bytes.
    $this->error_type           = 0; // error code.
    $this->randon_name          = TRUE;
    $this->replace              = TRUE;
  }
///////////////////////////////////////////////////////////////////
  /**
   * Set value to class variables.
   *
   * @param   string  $var
   * @param   string  $value
   * @access  public
  **/
  function set($var,$value){
    $this->$var = $value;
  }
///////////////////////////////////////////////////////////////////  
  /**
   * Get value of class variables.
   *
   * @param   string  $var
   * @access  public
  **/
  function get($var){
    return $this->$var;
  }
///////////////////////////////////////////////////////////////////
  /**
   * Check upload condictions for file and directory.
   * 
   * @access  private
   * @return  bool (true/false)
   * @uses    createDiretoryStructure()
  **/
  function checkUploadConditions(){

    //-------- extension and type check -----------//
    $arr = split("\.",$this->name);
    $ext = $arr[count($arr)-1];
    foreach($this->supported_extensions as $each_ext => $type)
//      if(strtolower($each_ext) == strtolower($ext) && $this->type == $type) $allow = TRUE;
      if(strtolower($each_ext) == strtolower($ext) ) $allow = TRUE;	  
    
    if(!$allow) {
      $this->error_type = 1;
      return FALSE;
    }
    //----------------------------------------------//

    //------ size check ----------------------------//
    if($this->size > $this->max_file_size) {
      $this->error_type = 2;
      return FALSE;
    }
    //----------------------------------------------//


    //----- directory check ------------------------//
    if(!file_exists($this->dst_dir)){
      if(!$this->createDiretoryStructure()){
        $this->error_type = 3;
        return FALSE;
      } else {
        return TRUE; 
      }
    } elseif (!is_writable($this->dst_dir)){ 
      $this->error_type = 4;
      return FALSE;
    } else {
      return TRUE;
    }
    //----------------------------------------------//

  }
///////////////////////////////////////////////////////////////////  
  /**
   * Try to create directory structure for upload.
   * 
   * @access  private
   * @return  bool (true/false)
  **/
  function createDiretoryStructure(){

    $arr = split("/",$this->dst_dir);

    /* Dumping possible garbage inside vector like 
       empty indexes leaved by repeated slashes.  */
    $j=0;
    for($i=0; $i < count($arr); $i++)
      if($arr[$i]) $new_arr[$j++] = $arr[$i];
    //---------------------------------------------//

    $arr = $new_arr;
    $end = count($arr);

    for($i=0; $i < $end; $i++){
      $path .= "/".$arr[$i];
      if(!file_exists($path)) {
        if(!@mkdir($path,0755)) { 
          $fail = TRUE; 
          break; 
        }
      }
    }

    if($fail) return FALSE; else return TRUE;
  }
///////////////////////////////////////////////////////////////////  
  /**
   * Execute the upload. 
   * This is the main function that should be used outside this class.
   * Also is responsable for keep track of succeed and failure uploads.
   * 
   * @access  public
   * @return  bool (true/false)
   * uses     checkUploadConditions(),generateFileName()
  **/
  function moveFileToDestination(){
    if(is_uploaded_file($this->tmp_name) && $this->dst_dir){
      if($this->checkUploadConditions()){
        $dst_file_name = $this->new_name;
        $full_destination_path = $this->dst_dir."/".$dst_file_name;
        if(file_exists($full_destination_path) && !$this->replace) {
          $this->error_type = 7;
        } else {
          if(@move_uploaded_file($this->tmp_name,$full_destination_path)){
            @chmod ($this->dst_dir."/".$dst_file_name,$this->file_perm);
            $this->error_type = 0; 
          } else {
            $this->error_type = 5; 
          }
        }
      }
    } else {
      $this->error_type = 6; 
    }
	return $this->error_type;
  }
///////////////////////////////////////////////////////////////////
}
?>