<?php
#####################################
#		IPOS V1.0 (TGT 4.5)			#
#		code by ichphienpro			#
#	email: ichphien_pro@yahoo.com	#
#####################################
class cache
{
    var $cache_dir = './cache/';
    var $cache_time = 100000;	// Thời gian để tạo cache mới
    var $caching = false;
    var $file = '';
    function cache()
    {
        $this->file = $this->cache_dir . urlencode( $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );
        if ( file_exists ( $this->file ) && ( fileatime ( $this->file ) + $this->cache_time ) > time() )
        {
            $handle = fopen( $this->file , "r");
            do {
                $data = fread($handle, 8192);
                if (strlen($data) == 0) {
                    break;
                }
                echo $data;
            } while (true);
            fclose($handle);
            exit();
        }
        else
        {
            $this->caching = true;
            ob_start();
        }
    }
   
    function close()
    {
        if ( $this->caching )
        {
            $data = ob_get_clean();
            echo $data;
            $fp = fopen( $this->file , 'w' );
            fwrite ( $fp , $data );
            fclose ( $fp );
        }
    }
}
?>