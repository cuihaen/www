<? 
session_start();

 ?>
<meta charset="utf-8">
<?
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION); 

	if(!$scale)$scale = 10;

	
	if (!$list_style)$list_style = 'list';	

	if(!$userid) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}
	//글쓰기 버튼 자체가 로그인 안하면 노출되지 않으므로 생략가능!

	if(!$subject) {
		echo("
	   <script>
	     window.alert('제목을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	if(!$content) {
		echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

	//수정글쓰기!
	if ($mode=="modify")
	{
    	$subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);
		$subject = str_replace("'", "&#039;", $subject);
		$content = str_replace("'", "&#039;", $content);

		$sql = "update greet set subject='$subject', content='$content' where num=$num";
		
		echo "
			<script>
				location.href = 'list.php?list_style=$list_style&page=$page&scale=$scale';
			</script>
		";
	}
	//새글쓰기!
	else
	{
		if ($html_ok=="y")
		{
			$is_html = "y";
		}
		else
		{
			$is_html = "";
			
		}
		
		$subject = htmlspecialchars($subject);
		$content = htmlspecialchars($content);
		$subject = str_replace("'", "&#039;", $subject);
		$content = str_replace("'", "&#039;", $content);

		//str_replace함수를 활용해 각각 요소를 직접 바꿔주어도 된다!
		//$subject = str_replace("'", "&#039;", $subject);
		//$content = str_replace("'", "&#039;", $content);
	 	//  "(&quot;) '(&#039;) &(&amp;) <(&lt;) >(&gt;)

		$sql = "insert into greet (id, name, nick, subject, content, regist_day, hit, is_html) ";
		$sql .= "values('$userid', '$username', '$usernick', '$subject', '$content', '$regist_day', 0, '$is_html')";

		echo "
			<script>
					location.href = 'list.php?list_style=$list_style&page=1&scale=$scale';
			</script>
		";
	}

	mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	mysql_close();                // DB 연결 끊기

?>

  
