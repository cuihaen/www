<? 
	session_start(); 
	
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION);
	
	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

	$row = mysql_fetch_array($result);       	
	$item_subject = $row[subject];
	$item_content = $row[content];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>삼양홀딩스-활동소식</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub4/common/css/sub4common.css">
	<link rel="stylesheet" href="./css/modify_form.css">

    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
</head>
<body>
	<div id="skipNav">
		<a href="#content">본문바로가기</a>
		<a href="#gnb">글로벌네비게이션바로가기</a>
	</div>
    <? include "../common/sub_header.html" ?>
	<div class="main">
		<h3>사회공헌</h3>
	</div>
	<div class="subNav">
		<ul>
			<li><a href="../sub4/sub4_1.html">사회공헌 개요</a></li>
			<li><a href="../sub4/sub4_2.html">주요활동</a></li>
			<li><a href="../sub4/sub4_3.html">재단</a></li>
			<li><a href="../sub4/sub4_4.html">사이클팀</a></li>
			<li><a class="current" href="./list.php">활동소식</a></li>
		</ul>
	</div>
	<article id="content">
		<div class="titleArea">
			<div class="lineMap">
				<span><i class="fa-solid fa-house-chimney"></i><span class="hidden">HOME</span></span>&gt;
				<span>  사회공헌 </span>&gt;
				<span>  활동소식</span>
			</div>
			<h2>활동소식</h2>
		</div>
		<div class="contentArea">
			<div class="summary">
				<p>삼양은 더불어 행복해지기 위해 인재육성, 환경보전, 건강증진을 위한<br>
					다양한 사회공헌 활동을 적극적으로 전개하고 있습니다.</p>    
			</div>
			<div class="write_content">
				<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>"> 
					<div id="write_form">
						<dl class="user_info">
							<dt>닉네임</dt>
							<dd><?=$usernick?></dd>
						</dl>
						<dl>
							<dt>제목</dt>
							<dd><input id="title_box" type="text" name="subject" value="<?=$item_subject?>" ></dd>
						</dl>
						<dl class="textBox">
							<dt>내용</dt>
							<dd><textarea  id="board_content" rows="15" cols="79" name="content"><?=$item_content?></textarea></dd>
						</dl>
					</div>
					<div id="write_button">
						<a href="list.php?list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">취소</a>
						<input class="compalte" type="submit" value="저장" onclick="list.php?list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">
					</div>
				</form>
			</div> 
		</div> 
	</article>
<? include "../common/sub_footer.html" ?>   
</body>
</html>