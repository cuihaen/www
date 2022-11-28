<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
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
    <link rel="stylesheet" href="./css/id_find.css">
    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../js/prefixfree.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".find").click(function() {    // id입력 상자에 id값 입력시
                var name = $('#name').val(); //홍길동
                var hp1 = $('#hp1').val(); //010
                var hp2 = $('#hp2').val(); //1111
                var hp3 = $('#hp3').val(); //2222

                $.ajax({
                    type: "POST",
                    url: "find.php", 
                    data: "name="+ name + "&hp1=" + hp1+ "&hp2=" + hp2 + "&hp3=" + hp3,  /*매개변수id도 같이 넘겨줌*/
                    cache: false, 
                    success: function(data) /*이 메소드가 완료되면 data라는 변수 안에 echo문이 들어감*/
                    {
                        $("#loadtext").html(data); /*span안에 있는 태그를 사용할것이기 때문에 html 함수사용*/
                    }
                });  
            }); 
            $(document).on('click','.close_btn','.modal_bg',function(){
                $('#loadtext').html('');
                $('.popup').fadeOut('fast');
                $('.modal_bg').fadeOut('fast');
           });
        });
    </script>
</head>
<body>
    <div id="wrap">
        <header>
            <h1 class=hidden>삼양홀딩스 아이디찾기</h1>
            <a class="logo" href="../index.html"><img src="../svg/samyang_CI.svg" alt="삼양홀딩스로고"></a> 
        </header>
        <article id="content">
            <form name="find" method="post" action="find.php">
            <div id="title">
                <h2>아이디찾기</h2>
                <p>가입 시 입력하신 정보로 아이디를 찾아드립니다</p>
            </div>
            <div id="login_form">
                <div class="clear"></div>
                <div id="login2">
                    <div id="id_input_button">
                        <fieldset>
                            <input type="text" name="name" class="find_input" id="name" placeholder="이름을 입력하세요.">
                            <div class="telBox">
                                <label class="hidden" for="hp1">연락처 앞3자리</label>
                                <select name="hp1" id="hp1" title="휴대폰 앞3자리를 선택하세요." class="find_input">
                                    <option>010</option>
                                    <option>011</option>
                                    <option>016</option>
                                    <option>017</option>
                                    <option>018</option>
                                    <option>019</option>
                                </select> ㅡ
                                <label class="hidden" for="hp2">연락처 가운데3자리</label>
                                <input class="find_input" type="text" id="hp2" name="hp2" title="연락처 가운데3자리를 입력하세요." maxlength="4" placeholder="ex)1234"> ㅡ
                                <label class="hidden" for="hp3">연락처 마지막3자리</label>
                                <input class="find_input" type="text" id="hp3" name="hp3" title="연락처 마지막3자리를 입력하세요." maxlength="4" placeholder="ex)5678">
                            </div>
                            <input type="button" value="아이디찾기" class="find">
                                        <!--↑ submit이 아닌 이유 
                                        = form으로 넘겼다가 다시 오는게 아니라 jquery ajax로 DB에 갔다 올거라서!  -->
                            <ul class="go">
                                <li><a href="login_form.php">로그인하기</a></li>
                                <li><a href="pw_find.php">비밀번호 찾기</a></li>
                            </ul>
                            <div id="join_button">
                                <span>아직 회원이 아니신가요?</span>
                                <a href="../member/member_check.html" class="go_join">회원가입</a>
                            </div>
                                    
                        </fieldset>
                                <!-- ↓ 찾은 정보를 출력하기 위한 BOX -->
                        <div class="modal_bg"></div>
                        <div class="popup">
                            <a href="#" class="close_btn"><span class="hidden">닫기</span><i class="fa-solid fa-xmark"></i></a>
                            <div id="loadtext"></div>
                            <a class="login_btn"href="login_form.php">로그인하기</a>
                            <div class="find_ps">
                                <span>비밀번호를 잊으셨나요?</span>
                                <a href="pw_find.php">비밀번호 찾기</a>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    
                </div>			 
            </div> <!-- end of form_login -->
            </form>
        </article> <!-- end of col2 -->
    </div>
</body>
</html>