<? 
	session_start(); 
	
	//새글쓰기
	//$table='products'

	//수정글쓰기
	//$table='products',$num=1,$mode=modify

	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION); 

	include "../lib/dbconn.php";

	if ($mode=="modify")  //수정글쓰기!
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
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
    <link rel="stylesheet" href="./css/write_form.css">

    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="../common/js/prefixfree.min.js"></script>
	<script>
	function check_input()
	{
		if (!document.board_form.subject.value)
		{
			alert("제목을 입력하세요!");    
			document.board_form.subject.focus();
			return;
		}

		if (!document.board_form.content.value)
		{
			alert("내용을 입력하세요!");    
			document.board_form.content.focus();
			return;
		}
		document.board_form.submit();
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
				<div class="write_content">
					<?
						if($mode=="modify")
						{

					?>
					<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
					<?
						}
						else
						{
					?>
					<form  name="board_form" method="post" action="insert.php?table=<?=$table?>&scale=<?=$scale?>" enctype="multipart/form-data"> 
					<!-- 'enctype' 은 form안에 첨부할 파일이 있을 때 무조건 넣어주어야하는 요소! -->
					<?
						}
					?>
						<div id="write_form">
							<dl class="user_info">
								<dt>닉네임</dt>
								<dd><?=$usernick?></dd>
							</dl>
							<dl>
								<dt>제목</dt>
								<dd>
									<?
										if($mode=="modify")
										{
									?>
									<input id="title_box" type="text" name="subject" value="<?=$item_subject?>">
									<?
										}	
										else if( $userid=="admin" && ($mode != "modify") )
										{
									?>
									<input id="title_box" type="text" name="subject" placeholder="게시글의 제목을 입력해주세요">
									<?
										}
									?>
								</dd>
							</dl>
							<dl class="textBox">
								<dt>내용</dt>
								<dd>
									<?
										if( $userid && ($mode != "modify") )
										{
									?>
									<div>
										<label for="html_ok">html쓰기</label>
										<input type="checkbox" name="html_ok" id="html_ok" value="y">
									</div>
									<?
										}
									?>
									<textarea id="board_content" rows="15" cols="79" name="content"><?=$item_content?></textarea>
									<div class="uploadImage">
										<dl>
											<dt> 이미지파일1</dt>
											<dd>
												<input type="file" name="upfile[]">
												<? 	if ($mode=="modify" && $item_file_0)
													{
												?>
													<span class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</span>
												<?
													}
												?>
											</dd>
										</dl>
										<dl>
											<dt>이미지파일2</dt>
											<dd>
												<input type="file" name="upfile[]">
												<? 	if ($mode=="modify" && $item_file_1)
													{
												?>
													<span class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</span>
												<?
													}
												?>
											</dd>
										</dl>
										<dl>
											<dt>이미지파일3</dt>
											<dd>
												<input type="file" name="upfile[]">
												<? 	if ($mode=="modify" && $item_file_2)
												{
												?>
													<span class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</span>
												<?
													}
												?>
											</dd>
										</dl>
									</div>
								</dd>						
							</dl>
						</div>
						<div id="write_button">
							<a href="list.php?table=<?=$table?>&page=<?=$page?>&scale=<?=$scale?>">취소</a>
							<a class="complate" href="#" onclick="check_input()">완료</a>
						</div>
					</form>
				</div> 
		</article> 
	<? include "../common/sub_footer.html" ?>   
	</body>
</html>
