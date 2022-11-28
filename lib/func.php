<?
   function latest_article($table, $loop, $char_limit) 
   {
		include "./lib/dbconn.php";

		$sql = "select * from $table order by num desc limit $loop";
		$result = mysql_query($sql, $connect);

		while ($row = mysql_fetch_array($result))
		{
			$num = $row[num];
			$len_subject = mb_strlen($row[subject], 'utf-8');
			$subject = $row[subject];
			$content_item = $row[content];

			if ($len_subject > $char_limit)
			{
				$subject = str_replace( "&#039;", "'", $subject);               
                $subject = mb_substr($subject, 0, $char_limit, 'utf-8');
				$subject = $subject."...";
			}


			$regist_day = substr($row[regist_day], 0, 10);
			$file_copied_0 = $row[file_copied_0];

			if($table=='news'){
				if($file_copied_0){
					echo "
					<li>
						<a href='./$table/view.php?table=$table&num=$num&page=1&scale=8'>
							<img src='./$table/data/$file_copied_0' alt = '대표이미지'>
							<dl>
								<dt>$subject</dt>
								<dd><p>$content_item</p>
									<span>$regist_day</span>
								</dd>
							</dl>
							<div class='more'>
								<i class='fa-solid fa-plus'></i>
							</div>
						</a>
					</li>		
					";
				}else{
					echo "
					<li>
						<a href='./$table/view.php?table=$table&num=$num&page=1&scale=8'>
							<img src='./$table/data/default.jpg' alt='대표 이미지가 없습니다.'>
							<dl>
								<dt>$subject</dt>
								<dd><p>$content_item</p>
									<span>$regist_day</span>
								</dd>
							</dl>
							<div class='more'>
								<i class='fa-solid fa-plus'></i>
							</div>
						</a>
					</li>		
					";
				}
			}
			
		}
		mysql_close();
   }
?>