<? 
	session_start(); 
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION); 
	
	include "../lib/dbconn.php";

	$ripple = "free_ripple";

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

	$sql = "select * from $ripple where parent=$item_num";
	$result2 = mysql_query($sql, $connect);
	$num_ripple = mysql_num_rows($result2); //해당 게시글에 댓글
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>삼양홀딩스-NEWS</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub6/common/css/sub6common.css">
    <link rel="stylesheet" href="./css/view.css">

    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
	<script>
		function check_input()
		{
			if (!document.ripple_form.ripple_content.value)
			{
				alert("내용을 입력하세요!");    
				document.ripple_form.ripple_content.focus();
				return;
			}
			document.ripple_form.submit();
		}
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
            <h3>고객지원</h3>
        </div>
		<div class="subNav">
            <ul>
                <li><a class="current" href="./list.php">NEWS</a></li>
                <li><a href="../sub6/sub6_2.html">FAQ</a></li>
                <li><a href="../sub6/sub6_3.html">Contact Us</a></li>
                <li><a href="../sub6/sub6_4.html">찾아오시는길</a></li>
            </ul>
        </div>
        <article id="content">
            <div class="titleArea">
                <div class="lineMap">
                    <span><i class="fa-solid fa-house-chimney"></i><span class="hidden">HOME</span></span>&gt;
                    <span>  고객지원 </span>&gt;
                    <span>  NEWS</span>
                </div>
                <h2>NEWS</h2>
            </div>
			<div class="contentArea">
                <!-- 본문콘텐츠영역 -->
				<div class="summary">
					<p>더 나은 세상을 만들어나가기 위해 지속적으로 노력하는<br>삼양홀딩스의 다양한 소식들을 만나보세요</p>
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
				<div class="ripple">
					<span>댓글
					<?
						if ($num_ripple)
						echo "<strong>[$num_ripple]</strong>";
					?>
					</span>
				<?
				$sql = "select * from free_ripple where parent='$item_num'";
				$ripple_result = mysql_query($sql);

				while ($row_ripple = mysql_fetch_array($ripple_result))
				{
					$ripple_num     = $row_ripple[num];
					$ripple_id      = $row_ripple[id];
					$ripple_nick    = $row_ripple[nick];
					$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
					$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
					$ripple_date    = $row_ripple[regist_day];
				?>
					<ul class="ripple_content">
						<li><?=$ripple_nick?></li>
						<li><p><?=$ripple_content?></p></li>
						<li><?=$ripple_date?></li>
						<li> 
							<? 
								if($userid=="admin" || $userid==$ripple_id)
								echo "<a class='delate_btn' href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>삭제</a>"; 
							?>
						</li>
					</ul>
				<?
						}
				?>			
					<form class="ripple_form" name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
						<div id="ripple_box">
							<span><?=$usernick?></span>
							<textarea rows="5" cols="65" name="ripple_content"></textarea>
							<a href="#" onclick="check_input()">등록</a>
						</div>
					</form>
				</div> <!-- end of ripple -->
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
