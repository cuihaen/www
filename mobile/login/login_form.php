<? session_start(); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon-precomposed" href="../app_icon.png">
    <link rel="apple-touch-startup-image" href="../startup.png">
    <title>회원가입-이용약관</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="./css/login_form.css">
    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="../js/prefixfree.min.js"></script>

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            var documentHeight =  $(document).height();
            $("#content").css('height',documentHeight); 
        });
    </script>
</head>
<body>
    <div id="wrap">
        <h1 class=hidden>삼양홀딩스 로그인</h1>
        <article id="content">
            <h2>LOGIN</h2>
            <p>회원가입시 등록하신 아이디와 비밀번호를 입력해주세요.</p>
            <form  name="member_form" method="post" action="login.php"> 
                <div id="id_pw_input">
                    <ul>
                        <li>
                            <label class="hidden" for="id">ID</label>
                            <input type="text" name="id" class="login_input" required placeholder="아이디를 입력하세요.">
                        </li>
                        <li> 
                            <label class="hidden" for="pass">PASSWORD</label>
                            <input type="password" name="pass" class="login_input" required placeholder="비밀번호를 입력하세요.">
                        </li>
                    </ul>						
                </div>
                <div id="login_button">
                    <button type="submit">로그인</button>
                </div>

                <ul class="find">
                    <li><a href="id_find.php">아이디 찾기</a></li>
                    <li><a href="pw_find.php">비밀번호 찾기</a></li>
                </ul>
                <div id="join_button">
                    <span>아직 회원이 아니신가요?</span>
                    <a href="../member/member_check.html">회원가입</a>
                </div>
            </form>
        </article>
    </div>
</body>
</html>