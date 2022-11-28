<? 
	session_start(); 
	
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION);

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];
		
    $item_date    = $row[regist_day];

	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	$new_hit = $item_hit + 1;

	$sql = "update greet set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
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
	<link rel="stylesheet" href="./css/view.css">

    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
	<script>
		function del(href) 
		{
			if(confirm("정말 삭제하시겠습니까?\n\n삭제된 게시글은 복구할 방법이 없습니다.")) {
					document.location.href = href;
			}
		}
	</script>
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
		<div class="selected_content">
			<div id="view_title">
				<div id="view_title1">
					<?= $item_subject ?>
				</div>
				<ul id="view_title2">
					<li><?= $item_nick ?></li>
					<li><?= $item_date ?></li>
					<li><i class="fa-regular fa-eye"></i> <?= $item_hit ?></li>
				</ul>	
			</div>
			<div id="view_content">
				<?= $item_content ?>
			</div>
			<div id="view_button">
				<? 
					if($userid )
					{
				?>
					<a class="write" href="write_form.php?num=<?=$num?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">글쓰기</a>
				<?
					}
				?>
				<? 
					if($userid==$item_id || $userlevel==1 || $userid=="admin")
					{
				?>
					<a href="modify_form.php?num=<?=$num?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">수정</a>
					<a href="javascript:del('delete.php?num=<?=$num?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>')">삭제</a>
				<?
					}
				?>
				<a class="list" href="list.php?list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">목록</a>
			</div>
		</div>
	</div> 
</article><!-- end of wrap -->
 <? include "../common/sub_footer.html" ?> 
</body>
</html>
