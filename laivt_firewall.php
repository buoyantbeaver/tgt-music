<?
//Code by Vu Thanh Lai
//Shared by: vu Thanh Lai
//Shared at: SinhVienIT.Net
//KO thanh doi 4 dong chu thich nay neu ban dc share de ton trong tac gia cung nhu ton trong cong suc cua nguoi share ! Thanks !
//---------------------------------------------------------------------------------------------------------------------------------------------------------------



include "laivt_firewall_conf.php";



//---Function----//
function get_ip()
{
	# Enable X_FORWARDED_FOR IP matching?
	$do_check = 0;
	$addrs = array();

	if( $do_check )
	{
		foreach( array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_f )
		{
			$x_f = trim($x_f);
			if( preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $x_f) )
			{
				$addrs[] = $x_f;
			}
		}

		$addrs[] = $_SERVER['HTTP_CLIENT_IP'];
		$addrs[] = $_SERVER['HTTP_PROXY_USER'];
	}

	$addrs[] = $_SERVER['REMOTE_ADDR'];

	foreach( $addrs as $v )
	{
		if( $v )
		{
			preg_match("/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/", $v, $match);
			$ip = $match[1].'.'.$match[2].'.'.$match[3].'.'.$match[4];

			if( $ip && $ip != '...' )
			{
				break;
			}
		}
	}

	if( ! $ip || $ip == '...' )
	{
		baoloi("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"> Sự truy cập của bạn bị cấm vì IP của bạn ko hợp lệ.");
		exit();
	}

	return $ip;
}


function baoloi($msg,$time=60)
{
	echo "
	<html>
	<head><title>SinhVienIT.Net-Firewall System</title>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"> 
         <meta http-equiv=\"Refresh\" Content=\"$time; url=\">
		<style type='text/css'>
			html{ overflow-x:auto; }
			body{ background:#FFF; color:#222; font-family:Arial, Verdana, Tahoma, Times New Roman, Courier; font-size:11px; line-height:135%; margin:0; padding:0; text-align:center; }
			a:link, a:visited, a:active{ background:transparent; color:#0066CC; text-decoration:none; }
			a:hover{ background:transparent; color:#000000; text-decoration:underline; }
			#wrapper{ margin:5px auto 20px auto; text-align:left; width:80%; }
			.borderwrap{ background:#FFF; border:1px solid #EEE; padding:3px; margin:0; }
			.borderwrap p{ background:#F9F9F9; border:1px solid #CCC; margin:5px; padding:10px; text-align:left; }
			.warnbox{ border:1px solid #F00; background:#FFE0E0; padding:6px; margin-right:1%; margin-left:1%; text-align:left; }
		</style>
	</head>
	<body>
	<div id='wrapper'><br /><br />
		<div class='borderwrap'>
			<p style='font-size:15pt; color:#FF3300;' id='tieude'><b>Cảnh báo:</b></p><br /><br />
			<div class='warnbox' id='canhbao'>
				<b>Phát hiện dấu hiệu Flood:<br>$msg";
if ($time!=-1)
	echo "Bạn vui lòng đợi <span id='time'>$time s</span><b> nữa.</b>";
echo "			</div><br />
		</div><br />
		<div align='center' style='border:1px solid #EEE; padding:5px 0px 5px 5px; color:#808080; font-face:Tahoma;'>Laivt_Firewall 1.1 by <a href='http://sinhvienit.net/'>SinhVienIT.Net</a> &copy; ".date('Y')." </div>";
if ($time!=-1)
	echo "<script> 
 var milisec=0 
 var seconds=$time 
 document.getElementById('time').innerHTML = '$time'

function display(){
 if (milisec<=0){ 
    milisec=9 ;
    seconds-=1 ;
 } 
  else 
	milisec-=1;

if (seconds<=-1){
	milisec=0; 
	seconds+=1; 
}

	document.getElementById('time').innerHTML = seconds+'.'+milisec + 's';
	if (seconds==0 && milisec==0)
		{
			document.getElementById('canhbao').innerHTML = \"<b>Vui lòng bấm phím F5 để nạp lại trang hoặc bấm <a href=''>vào đây nếu chờ quá lâu.</a></b>\";
			document.getElementById('tieude').innerHTML = \"<b>Bạn có thể truy cập lại</b>\";
			window.localtion.href='';
		}
    setTimeout(\"display()\",100) ;
} 
display();

</script> ";
echo "
	</div>
	</body>
	</html>";
	exit();
}
//--Xu ly truy cap
$ip=get_ip();
$now=time();
	if (file_exists("laivt_firewall/$ip".".deny"))//Neu bi khoa vinh vien
		{
			//Cam bang htaccess
			@chmod($laivt_fw_conf['htaccess'], 0666);
			@$ft=fopen($laivt_fw_conf['htaccess'],"a");
			@fwrite($ft,"deny from $ip\n");
			@fclose($ft);
			baoloi("IP của bạn <font color='red'>$ip</font> đã bị khóa truy cập để đảm bảo an toàn (Do hệ thông phát hiện dấu hiệu Flood nhiều lần từ IP của bạn).<br />Vui lòng sử dung email lúc bạn đã đăng kí thành viên liên lạc với BQT (Nhớ gửi kèm tên tài khoản),<br /> qua email <a href='mailto:{$laivt_fw_conf['email_admin']}'>{$laivt_fw_conf['email_admin']}</a> để bỏ khóa cho ip bạn(Nếu ko, IP sẽ dc tự mở khóa sau 24h)",-1);
		}
	elseif (file_exists("laivt_firewall/$ip".".lock")) //Neu dang bi khoa tam thoi
		{
			@chmod("laivt_firewall/$ip".".lock", 0666);
			@$time=file_get_contents("laivt_firewall/$ip".".lock");
			if (file_exists("laivt_firewall/$ip".".lockcount"))
				$lock_count=file_get_contents("laivt_firewall/$ip".".lockcount");
			else
				$lock_count=0;
			$wait=(($laivt_fw_conf['time_wait']*($lock_count+1))+$time)-$now;
			if ($wait>0)//Neu chu het thoi gian khoa
				{
					baoloi("IP của bạn <font color='red'>$ip</font> đã bị khóa truy cập để đảm bảo an toàn.",$wait);
				}
			else //Neu da het thoi gian doi thi bo khoa
				{
					@unlink("laivt_firewall/$ip".".lock");
					@chmod("laivt_firewall/$ip", 0666);
					@$ft=fopen("laivt_firewall/$ip","w");
					@fwrite($ft,"1|".$now);
					@fclose($ft);
				}
		}
	else //Neu chua bi khoa vinh vien va tam thoi
		{
			//Kiem tra xem IP nay da tung truy cap chua
			if (file_exists("laivt_firewall/$ip"))
				{
					//Neu IP nay da tung truy cap thi kiem tra so ket noi
					@chmod("laivt_firewall/$ip", 0666);
					@$c=file_get_contents("laivt_firewall/$ip");
					$sinhvienit=explode("|",$c);
					$con=$sinhvienit[0];
					$firttime=$sinhvienit[1];
					if (($con+1)>=$laivt_fw_conf['max_connect'] && ($now-$firttime)<=$laivt_fw_conf['time_limit'])
						{
							//Neu so ket noi trong thoi gian gioi han lon hon quy dinh thi khoa IP tam thoi	
							@chmod("laivt_firewall/$ip".".lock", 0666);							
							$ft=fopen("laivt_firewall/$ip".".lock","w");
							fwrite($ft,$now);
							fclose($ft);
								//Kiem tra xem IP nay da dat toi muc gioi han de khoa vinh vien hay ko
								if (file_exists("laivt_firewall/$ip".".lockcount"))
									{
										@chmod("laivt_firewall/$ip".".lockcount", 0666);
										@$lock_count=file_get_contents("laivt_firewall/$ip".".lockcount");
										
									}
								else
									$lock_count=0;
								if (($lock_count+1)>=$laivt_fw_conf['max_lockcount'])
									{
										//Tang so lan khoa tam thoi len
										@chmod("laivt_firewall/$ip".".lockcount", 0666);	
										@$ft=fopen("laivt_firewall/$ip".".lockcount","w");
										@fwrite($ft,$lock_count+1);
										@fclose($ft);
										//Tien hanh khoa vinh vien bang firewall
										@chmod("laivt_firewall/$ip".".deny", 0666);	
										@$ft=fopen("laivt_firewall/$ip".".deny","w");
										@fclose($ft);
										//Tien hanh khoa vinh vien bang htaccess
										@chmod($laivt_fw_conf['htaccess'], 0666);
										@$ft=fopen($laivt_fw_conf['htaccess'],"a");
										@fwrite($ft,"deny from $ip\n");
										@fclose($ft);
										//Thong bao cho nguoi dung biet la minh bi khoa IP
										baoloi("IP của bạn <font color='red'>$ip</font> đã bị khóa truy cập để đảm bảo an toàn (Do hệ thông phát hiện dấu hiệu Flood nhiều lần từ IP của bạn).<br />Vui lòng sử dung email lúc bạn đã đăng kí thành viên liên lạc với BQT (Nhớ gửi kèm tên tài khoản),<br /> qua email <a href='mailto:{$laivt_fw_conf['email_admin']}'>{$laivt_fw_conf['email_admin']}</a> để bỏ khóa cho ip bạn(Nếu ko, IP sẽ dc tự mở khóa sau 24h)",-1);
									}
								else
									{
										@chmod("laivt_firewall/$ip".".lockcount", 0666);	
										@$ft=fopen("laivt_firewall/$ip".".lockcount","w");
										@fwrite($ft,$lock_count+1);
										@fclose($ft);
										baoloi("IP của bạn <font color='red'>$ip</font> đã bị khóa truy cập để đảm bảo an toàn.",$wait);
										
									}
						}
					elseif (($con+1)<$laivt_fw_conf['max_connect'] && ($now-$firttime)>=$laivt_fw_conf['time_limit'])
						{
						//Neu da qua muc thoi gian kiem tra thi reset lai
						@chmod("laivt_firewall/$ip", 0666);	
						@$ft=fopen("laivt_firewall/$ip","w");
						@fwrite($ft,"1|".$now);
						@fclose($ft);
						}
					else
						{
							@chmod("laivt_firewall/$ip", 0666);	
							@$ft=fopen("laivt_firewall/$ip","w");
							@fwrite($ft,($con+1)."|".$now);
							@fclose($ft);
						}
				}
			else
				{
					//Neu IP nay chua tung truy cap
					@chmod("laivt_firewall/$ip", 0666);	
					@$ft=fopen("laivt_firewall/$ip","w");
					@fwrite($ft,"1|".$now);
					@fclose($ft);
				}
		}

?>