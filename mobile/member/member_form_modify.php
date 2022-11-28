<?
    session_start();

    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon-precomposed" href="../app_icon.png">
    <link rel="apple-touch-startup-image" href="../startup.png">
    <title>회원가입-이용약관</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="./css/member_form_modify.css">
    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script>
        function check_id()
        {
            window.open("check_id.php?id=" + document.member_form.id.value,
                "IDcheck",
                "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
        }

        function check_nick()
        {
            window.open("../member/check_nick.php?nick=" + document.member_form.nick.value,
                "NICKcheck",
                "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
        }
        $(document).ready(function() {
            //비밀번호 일치검사
            $('#pass_confirm').keyup(function(){
                var pass1 = $('#pass').val();
                var pass2 = $('#pass_confirm').val();

                if(pass1==pass2){
                    $('#loadtext1').html('비밀번호가 일치합니다.').css('color','#1b8ab3');
                }else{
                    $('#loadtext1').html('비밀번호가 일치하지 않습니다.').css('color','#bd0202');
                }
            })
            //닉네임 중복검사
            $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
                var nick = $('#nick').val();

                $.ajax({
                    type: "POST",
                    url: "check_nick.php",
                    data: "nick="+ nick,  
                    cache: false, 
                    success: function(data)
                    {
                        $("#loadtext2").html(data);
                    }
                });
            });	
        });

        function check_input()
        {
            if (!document.member_form.pass.value)
            {
                alert("비밀번호를 입력하세요");    
                document.member_form.pass.focus();
                return;
            }

            if (!document.member_form.pass_confirm.value)
            {
                alert("비밀번호확인을 입력하세요");    
                document.member_form.pass_confirm.focus();
                return;
            }

            if (!document.member_form.name.value)
            {
                alert("이름을 입력하세요");    
                document.member_form.name.focus();
                return;
            }

            if (!document.member_form.nick.value)
            {
                alert("닉네임을 입력하세요");    
                document.member_form.nick.focus();
                return;
            }

            if (!document.member_form.hp2.value || !document.member_form.hp3.value )
            {
                alert("휴대폰 번호를 입력하세요");    
                document.member_form.nick.focus();
                return;
            }

            if (document.member_form.pass.value != 
                    document.member_form.pass_confirm.value)
            {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return;
            }

            document.member_form.submit();
        }

        function reset_form()
        {
            document.member_form.id.value = "";
            document.member_form.pass.value = "";
            document.member_form.pass_confirm.value = "";
            document.member_form.name.value = "";
            document.member_form.nick.value = "";
            document.member_form.hp1.value = "010";
            document.member_form.hp2.value = "";
            document.member_form.hp3.value = "";
            document.member_form.email1.value = "";
            document.member_form.email2.value = "";
            
            document.member_form.pass.focus();

            return;
        }
    </script>
</head>
<?
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    //세션변수를 통해 아이디에 해당하는 레코드를 불러온다!
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);

    $hp = explode("-", $row[hp]);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close();
?>
<body>
    <div id="wrap">
        <header>
            <h1 class=hidden>삼양홀딩스 회원정보수정</h1>
            <a class="logo" href="../index.html"><img src="../svg/samyang_CI.svg" alt="삼양홀딩스로고"></a> 
        </header>
        <article id="content">
            <h2>회원정보수정</h2>
            <p><span class="must">*</span>는 필수입력 항목입니다.</p>
            <form  name="member_form" method="post" action="modify.php"> 
                <ul id="form_join">
                    <li>
                        <span>아이디<span class="must">*</span></span>
                        <span class="user_id"><?= $row[id] ?></span>
                    </li>
                    <li>
                        <span>비밀번호<span class="must">*</span></span>
                        <span><input type="password" name="pass" id="pass" value="" placeholder="ex) samyang12!"></span>
                    </li>
                    <li>
                        <span>비밀번호 확인<span class="must">*</span></span>
                        <span>
                            <input type="password" name="pass_confirm" id="pass_confirm" value="" placeholder="ex) samyang12!">
                            <span id="loadtext1"></span>
                        </span>
                    </li>
                    <li>
                        <span>이름<span class="must">*</span></span>
                        <span><input type="text" name="name" value="<?= $row[name] ?>"></span>
                    </li>
                    <li>
                        <span>닉네임<span class="must">*</span></span>
                        <span>
                            <input type="text" name="nick" id ="nick" value="<?= $row[nick] ?>">
                            <span id="loadtext2"></span>
                        </span>
                    </li>
                    <li class="telBox">
                        <span>휴대폰<span class="must">*</span></span>
                        <span>
                            <label class="hidden" for="hp1">전화번호앞3자리</label>
                            <select class="hp" name="hp1" id="hp1"> 
                                <option value='010' <? if ($hp1=='010') echo 'selected' ?>>010</option>
                                <option value='011' <? if ($hp1=='011') echo 'selected' ?>>011</option>
                                <option value='016' <? if ($hp1=='016') echo 'selected' ?>>016</option>
                                <option value='017' <? if ($hp1=='017') echo 'selected' ?>>017</option>
                                <option value='018' <? if ($hp1=='018') echo 'selected' ?>>018</option>
                                <option value='019' <? if ($hp1=='019') echo 'selected' ?>>019</option>
                            </select>
                        - <input type="text" id="hp2" name="hp2" value="<?= $hp2 ?>"> 
                        - <input type="text" id="hp3" name="hp3" value="<?= $hp3 ?>">
                        </span>
                    </li>
                    <li>
                        <span>이메일</span>
                        <span><input type="text" id="email1" name="email1" value="<?= $email1 ?>">
                            @ <input type="text" name="email2" value="<?= $email2 ?>">
                        </span>
                    </li>
                </ul>
                <div class="button">
                    <a href="#" class="save" onclick="check_input()">저장하기</a>
                    <button type="button" onclick="reset_form()" class="reset">새로고침</button>
                </div>
            </form>
        </article>
    </div>
</body>
</html>
