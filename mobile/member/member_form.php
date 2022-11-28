<? 
	session_start(); 
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
    <link rel="stylesheet" href="./css/member_form.css">
    <script src="https://kit.fontawesome.com/2b8b92cff2.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../js/prefixfree.min.js"></script>
	<script>
        $(document).ready(function() {
            //id 중복검사
            $("#id").keyup(function() {    // id입력 상자에 id값 입력시
                var id = $('#id').val(); //aaa

                $.ajax({
                    type: "POST",
                    url: "check_id.php",
                    data: "id="+ id,  
                    cache: false, 
                    success: function(data)
                    {
                        $("#loadtext").html(data);
                    }
                });
            });

            //비밀번호 일치검사
            $('#pass_confirm').keyup(function(){
                var pass1 = $('#pass').val();
                var pass2 = $('#pass_confirm').val();

                if(pass1==pass2){
                    $('#loadtext2').html('비밀번호가 일치합니다.').css('color','#1b8ab3');
                }else{
                    $('#loadtext2').html('비밀번호가 일치하지 않습니다.').css('color','#bd0202');
                }
            })
                    
            //nick 중복검사		 
            $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
                var nick = $('#nick').val();

                $.ajax({
                    type: "POST",
                    url: "check_nick.php",
                    data: "nick="+ nick,  
                    cache: false, 
                    success: function(data)
                    {
                        $("#loadtext3").html(data);
                    }
                });
            });		 
        });
	</script>
	<script>
        function check_input(){
            if (!document.member_form.id.value)
            {
                alert("아이디를 입력하세요");    
                document.member_form.id.focus();
                return false;
            }

            if (!document.member_form.pass.value)
            {
                alert("비밀번호를 입력하세요");    
                document.member_form.pass.focus();
                return false;
            }

            if (!document.member_form.pass_confirm.value)
            {
                alert("비밀번호확인을 입력하세요");    
                document.member_form.pass_confirm.focus();
                return false;
            }

            if (!document.member_form.name.value)
            {
                alert("이름을 입력하세요");    
                document.member_form.name.focus();
                return false;
            }

            if (!document.member_form.nick.value)
            {
                alert("닉네임을 입력하세요");    
                document.member_form.nick.focus();
                return false;
            }


            if (!document.member_form.hp2.value || !document.member_form.hp3.value )
            {
                alert("휴대폰 번호를 입력하세요");    
                document.member_form.nick.focus();
                return false;
            }

            if (document.member_form.pass.value != 
                    document.member_form.pass_confirm.value)
            {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return false;
            }

            document.member_form.submit(); 
                // insert.php 로 변수 전송
        }
        function reset_form(){
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
            
            document.member_form.id.focus();
            return false;
        }
    </script>
</head>
<body>
    <div id="wrap">
        <header>
            <h1 class=hidden>삼양홀딩스 회원가입 정보입력</h1>
            <a class="logo" href="../index.html"><img src="../svg/samyang_CI.svg" alt="삼양홀딩스로고"></a> 
        </header>
        <article id="content">
            <h2 class=hidden>회원가입</h2>
            <div class="lineMap">
                <span>약관동의</span>
                <span class="current">정보입력</span>
                <span>가입완료</span>
            </div>
            <p><span class="must">*</span>는 필수입력 항목입니다.</p>
        <form  name="member_form" method="post" action="insert.php"> 
            <table>
            <caption class="hidden">회원가입</caption>
                <tr>
                    <th scope="col"><label for="id">아이디<span class="must">*</span></label></th>
                    <td>
                        <input type="text" name="id" id="id" required>
                        <span id="loadtext"></span>
                        <!-- 사용가능한 아이디입니다! 또는 다른 아이디를 사용하세요 라는 메세지가 뜸 = 중복검사 -->
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label for="pass">비밀번호<span class="must">*</span></label></th>
                    <td>
                        <input type="password" name="pass" id="pass" required>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label for="pass_confirm">비밀번호확인<span class="must">*</span></label></th>
                    <td>
                        <input type="password" name="pass_confirm" id="pass_confirm" required>
                        <span id="loadtext2"></span>
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label for="name">이름<span class="must">*</span></label></th>
                    <td>
                        <input type="text" name="name" id="name"  required> 
                    </td>
                </tr>
                <tr>
                    <th scope="col"><label for="nick">닉네임<span class="must">*</span></label></th>
                    <td>
                        <input type="text" name="nick" id="nick"  required>
                        <span id="loadtext3"></span>
                        <!-- 사용가능한 닉네임입니다! 또는 다른 닉네임을 사용하세요 라는 메세지가 뜸 = 중복검사-->
                    </td>
                </tr>
                <tr>
                    <th scope="col">휴대폰<span class="must">*</span></th>
                    <td>
                        <label class="hidden" for="hp1">전화번호앞3자리</label>
                        <select class="hp" name="hp1" id="hp1"> 
                            <option value='010'>010</option>
                            <option value='011'>011</option>
                            <option value='016'>016</option>
                            <option value='017'>017</option>
                            <option value='018'>018</option>
                            <option value='019'>019</option>
                        </select>  - 
                <label class="hidden" for="hp2">전화번호중간4자리</label><input type="text" class="hp" name="hp2" id="hp2"  required> - <label class="hidden" for="hp3">전화번호끝4자리</label><input type="text" class="hp" name="hp3" id="hp3"  required>
                        
                    </td>
                </tr>
                <tr>
                    <th scope="col">이메일<span class="must">*</span></th>
                    <td>
                    <label class="hidden" for="email1">이메일아이디</label>
                        <input type="text" id="email1" name="email1"  required> @ 
                        <label class="hidden" for="email2">이메일주소</label>
                        <input type="text" name="email2" id="email2"  required>
                    </td>
                </tr> 
            </table>
            </form>
            <div class=button>
                <a href="#" onclick="check_input()" class="join">회원가입</a>
                <button type="button" onclick="reset_form()" class="reset">새로고침</button>
            <div>
        </article>
    </div>
</body>
</html>


