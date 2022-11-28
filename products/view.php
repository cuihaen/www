<? 
	session_start(); 
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION); 
	
	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];


	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}
	//첨부된 이미지 가져오기!
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) //첨부된 이미지가 있으면!
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			//GetImageSize  = 배열로 리턴 [이미지의 너비값, 이미지의 높이, 이미지타입]

			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;//이미지 너비를 제한한다!
		}
		else  //첨부된 이미지가 없으면!
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>삼양홀딩스-제품검색</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub3/common/css/sub3common.css">
    <link rel="stylesheet" href="./css/view.css">

    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
	<script>
		function del(href) 
		{
			if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
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
		<h3>정보센터</h3>
	</div>
	<div class="subNav">
		<ul>
			<li><a href="../sub3/sub3_1.html">홍보관</a></li>
			<li><a href="../sub3/sub3_2.html">투자정보</a></li>
			<li><a href="../sub3/sub3_3.html">IR자료실</a></li>
			<li><a class="current" href="./list.php">제품검색</a></li>
		</ul>
	</div>
	<article id="content">
		<div class="titleArea">
			<div class="lineMap">
				<span><i class="fa-solid fa-house-chimney"></i><span class="hidden">HOME</span></span>&gt;
				<span>  정보센터  </span>&gt;
				<span>  제품검색</span>
			</div>
			<h2>제품검색</h2>
		</div>
		<div class="contentArea">
			<!-- 본문콘텐츠영역 -->
			<div class="summary">
				<p>삼양홀딩스는 고객의 더욱 편리하고 풍요로운 생활을 위해<br>
				최고 기술과 최상의 품질을 목표로 끊임없이 노력하고 있습니다.</p>
			</div>
		
			<div  class="selected_content">
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
					<?
						for ($i=0; $i<3; $i++)
						{
							if ($image_copied[$i])
							{
								$img_name = $image_copied[$i];
								$img_name = "./data/".$img_name;
								$img_width = $image_width[$i];
								
								echo "<img src='$img_name' width='$img_width'>"."<br><br>";
							}
						}
					?>
					<?= $item_content ?>
				</div>
				<div id="view_button">
					<? 
						if($userid=="admin" || $userlevel==1)
						{
					?>
						<a class="write" href="write_form.php?table=<?=$table?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">글쓰기</a>
						<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">수정</a>
						<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>')">삭제</a>
					<?
						}
					?>
					<a class="list" href="list.php?table=<?=$table?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">목록</a>
				</div>
			</div>
		</div>
	</div> 
</article>
<? include "../common/sub_footer.html" ?> 
</body>
</html>
