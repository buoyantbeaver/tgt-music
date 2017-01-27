<?
//Code by Vu Thanh Lai
//Shared by: vu Thanh Lai
//Shared at: SinhVienIT.Net
//KO thanh doi 4 dong chu thich nay neu ban dc share de ton trong tac gia cung nhu ton trong cong suc cua nguoi share ! Thanks !
//---------------------------------------------------------------------------------------------------------------------------------------------------------------

include "laivt_firewall_conf.php";

//--------Function
function xoa($dir) {
    if ( $dirHandle = opendir($dir) ) {
        while ( $file = readdir($dirHandle) ) {
            if ( $file !== "." && $file !== ".." ) {
				if (basename($file)!=".htaccess")
                    @unlink($dir."/".$file);
            }
        }
        closedir($dirHandle);
        return true;
    } else {
        return false;
    }
}


//-----------Unlock
//Bo Cam bang htaccess
$ft=fopen($laivt_fw_conf['htaccess'],"w");
fclose($ft);
//Bo cam tren Firewall
xoa("laivt_firewall");