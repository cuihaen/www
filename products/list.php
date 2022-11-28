<? 
	session_start(); 

	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION); 

	$table = "products";
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
    <link rel="stylesheet" href="./css/list.css">

    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
</head>
<?
	include "../lib/dbconn.php";
	if(!$scale)$scale = 10;		// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>
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
				<form class="board" name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search&list_style=<?=$list_style?>"> 
					<select name="find" id="find">
						<option value='subject'>제목</option>
						<option value='content'>내용</option>
						<option value='nick'>별명</option>
						<option value='name'>이름</option>
					</select>
					<input type="text" name="search" id="search">
					<input type="submit" value="검색" id="searchBtn">
				</form>
				<div class="top_section">
					<div id="total_list">총 <span><?= $total_record ?></span> 개의 게시물이 있습니다.</div>
					<div class="right">
						<ul class="list_style">
							<li class="active">
								<a href="list.php?num=<?=$item_num?>&list_style=list&page=<?=$page?>&scale=<?=$scale?>">
									<span class="hidden">목록형</span>
									<i class="fa-solid fa-list"></i>
								</a>
							</li>
							<li>
								<a href="list.php?num=<?=$item_num?>&list_style=box&page=<?=$page?>&scale=<?=$scale?>">
									<span class="hidden">박스형</span>
									<i class="fa-solid fa-table-cells-large"></i>
								</a>
							</li>
						</ul>
						<div class="list_count">
							<label for="scale" class="hidden">리스트개수</label>
							<select id="scale" name="scale" onchange="location.href='list.php?&list_style=<?=$list_style?>&scale='+this.value">
								<option value='10' <? if ($scale=='') echo 'selected' ?>>게시글수</option>
								<option value='6' <? if ($scale=='6') echo 'selected' ?>>6개씩</option>
								<option value='10' <? if ($scale=='10') echo 'selected' ?>>10개씩</option>
								<option value='14' <? if ($scale=='14') echo 'selected' ?>>14개씩</option>
								<option value='20' <? if ($scale=='20') echo 'selected' ?>>20개씩</option>
							</select>		
						</div>
					</div>
				</div>
				<div class="main_board">	
					<ul id="list_top_title">
						<li id="list_title1">번호</li>
						<li id="list_title2">제목</li>
						<li id="list_title3">작성자</li>
						<li id="list_title4">작성일자</li>
						<li id="list_title5">조회수</li>
					</ul>		
					<div id="list_content">
						<?		
						for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
						{
							mysql_data_seek($result, $i);       
							// 가져올 레코드로 위치(포인터) 이동  
							$row = mysql_fetch_array($result);       
							// 하나의 레코드 가져오기
							
							$item_num     = $row[num];
							$item_id      = $row[id];
							$item_name    = $row[name];
							$item_nick    = $row[nick];
							$item_hit     = $row[hit];
							$item_date    = $row[regist_day];
							$item_date = substr($item_date, 0, 10);  
							$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
							$item_content = $row[content];

							if($row[file_copied_0]){
								$item_img = './data/'.$row[file_copied_0];
							}else{
								$item_img = './data/default.jpg';
							}
							
						?>
							<ul id="list_item">
								<li id="list_item1"><?= $number ?></li>
								<li id="list_item_img"><img src="<?= $item_img ?>" alt="제품이미지"></li>
								<li id="list_item2">
									<a href="view.php?table=<?=$table?>&num=<?=$item_num?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">
									<span><?= $item_subject ?></span>
									<p><?=$item_content?></p></a>
								</li>
								<li id="list_item3"><?= $item_nick ?></li>
								<li id="list_item4"><?= $item_date ?></li>
								<li id="list_item5"><i class="fa-regular fa-eye"></i><?= $item_hit ?></li>
								
							</ul>
						<?
							$number--;
						}
						?>
					</div>
					<div id="page_button">
						<div id="page_num"> <i class="fa-solid fa-caret-left"></i> 이전 &nbsp;&nbsp;&nbsp;&nbsp; 
						<?
							// 게시판 목록 하단에 페이지 링크 번호 출력
							for ($i=1; $i<=$total_page; $i++)
							{
									if ($page == $i)     // 현재 페이지 번호 링크 안함
									{
										echo "<b> $i </b>";
									}
									else
									{ 
										echo "<a href='list.php?list_style=$list_style&page=$i&scale=$scale'> $i </a>";
									}      
							}
						?>			
						&nbsp;&nbsp;&nbsp;&nbsp;다음 <i class="fa-solid fa-caret-right"></i>
						</div>
					</div>
					<div id="button">
						<? 
							if($userid=="admin")
							{
						?>
						<a class="write" href="write_form.php?table=<?=$table?>&list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">글쓰기</a>
						<?
							}
						?>
						<a href="list.php?list_style=<?=$list_style?>&page=<?=$page?>&scale=<?=$scale?>">목록</a>
					</div>
				</div> <!-- end of page_button -->
			</div>
		</div>		
	</article>
<? include "../common/sub_footer.html" ?>
<?
	if (!$list_style){
		$list_style = 'list';	// 리스트 스타일
		echo "
			<script>
				$('.list_style li').removeClass('active');
				$('.list_style li:eq(0)').addClass('active');
			</script>
		";
	} else if($list_style == 'box'){	// 리스트 스타일
		echo "
			<script>
				$('.list_style li').removeClass('active');
				$('.list_style li:eq(1)').addClass('active');
				$('.main_board').addClass('box');
			</script>
		";

	}
?>
</body>
</html>
