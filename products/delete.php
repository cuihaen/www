<?
   session_start();

   @extract($_POST);
	@extract($_GET);
	@extract($_SESSION); 
   
   include "../lib/dbconn.php";

   $sql = "select * from $table where num = $num";
   $result = mysql_query($sql, $connect);

   $row = mysql_fetch_array($result);

   $copied_name[0] = $row[file_copied_0];
   $copied_name[1] = $row[file_copied_1];
   $copied_name[2] = $row[file_copied_2];

   for ($i=0; $i<3; $i++)
   {
		if ($copied_name[$i]) //첨부된 파일이 있으면 
	   {
			$image_name = "./data/".$copied_name[$i];  //data폴더 안에 있는 이미지를
			unlink($image_name);  //삭제해라!(unlink메소드!+실제 이미지 데이터 경로 = 이미지 삭제!);
	   }
   }

   $sql = "delete from $table where num = $num";
   mysql_query($sql, $connect);

   mysql_close();

   echo "
	   <script>
	    location.href = 'list.php?table=$table&page=$page&scale=$scale';
	   </script>
	";
?>

