<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MovieVerse</title>

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/basic.css">
	<link rel="shortcut icon" href="#">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<script>
List = [];
</script>

<div>
<?php 
	require("db_connect.php");
	session_start();
	$_SESSION["userId"] = empty($_SESSION["userId"]) ? "" : $_SESSION["userId"];
	
$query3 = $db->query("SELECT title FROM tv UNION SELECT title  FROM movie "); 
	while ($row = $query3->fetch()) {
	
	
	

?>
<script>
List.push('<?=$row['title'];?>');
</script>
<?php
}
?>

</div>
<script>

    $(function() {
        $("#searchInput").autocomplete({
            source: List,
            focus: function(event, ui) {
                return false;
            },
            minLength: 1,
            delay: 100,


        });
    });
</script>
<body>
    <div class="all">
        <header>
            <div class="head">

                <img class="logo" onclick="location.href='index.php?'" src="img/logo.png">
                <a style="color: #3482EA;" class="home" onclick="location.href='index.php?bid='"> 홈 </a>
                <a class="dramatap" onclick="location.href='drama.php?bid=';"> 드라마/시리즈</a>
                <a class="movietap" onclick="location.href='movie.php?bid=';"> 영화</a>
				<?php if($_SESSION["userId"]=="admin") {
					?>
				<a style="margin-left:50px; width:auto;"class="movietap" onclick="location.href='./phptest/list.php';"> 관리자 페이지</a>
				<?php  } ?>
			  <form class="serch" action="search_result.php" method="get">
                    <input id="searchInput" type="text" placeholder="드라마/시리즈, 영화 제목 검색해주세요" name="search" size="35" required="required" />
                    <input class="serch_Img" name="button" type="image" src="img/serch.png" />
                </form>


                <?php 

if(	$_SESSION["userId"]!=""){

	$query3 = $db->query("select *  from user where email='$_SESSION[userId]' "); 
	while ($row = $query3->fetch()) {
	$iset=$row['img_link'];
	}
	
?>
                <script>
                    function doDisplay() {
                        var asd = document.getElementById("userDiv");
                        if (asd.style.display == 'none') {
                            asd.style.display = 'block';
                        } else {
                            asd.style.display = 'none';
                        }

                    }
                </script>
                <img class="user_img" onclick="javascript:doDisplay();" src="user_img/<?= $iset?>">
                <?php
	   }else{
?>
                <button class="login_btn" onclick="location.href='login.php';">로그인</button>
                <?php	   
	   }
?>
            </div>
            <div style="display: none;" id="userDiv">
                <h3><img style="width:40px;height:40px;"class="userimg" src="user_img/<?= $iset?>"><?=$_SESSION["userName"]?></h3>
                <ul>
                    <li onclick="location.href='myinfo.php';"><img class="userimg" src="img/user.png">내 계정정보</li>
                    <li onclick="location.href='pwre.php';"><img class="userimg" src="img/lock.png">비밀번호 수정</li>
                    <li onclick="location.href='mybook.php';"><img class="userimg" src="img/bookmark.png">내 북마크</li>
                    <li onclick="location.href='myreview.php';"><img class="userimg" src="img/review.png">작성한 평가</li>
                    <li onclick="location.href='log_out.php';"><img class="userimg" src="img/logout.png">로그아웃 </li>
            </div>
            <div class="main_img_div">


                <img class="main_img" src="img/main_img.jpg">
				<p class="Services-on-MovieVerse">Services on MovieVerse</p>
                <img class="text" src="img/main_logo.png">          </img>
                <p style="left: 773px;" class="text_p">다양한 스트리밍 독점작들을 한 곳에서 <br>편리하게 확인해보세요.</p>
                <p class="text_p2">Streaming services on MovieVerse</p>
				<?php

	$query3 = $db->query("select * FROM streaming ");
while ($row = $query3->fetch()) {

?>
<img onclick="location.href='movie.php?platform=<?=$row['provider_id']?>';" style="margin-left:10px;"class="logoicon"src="img/<?=$row['logo_path']?>">
<?php
}
?>
            </div>

			
			
            <div class="img_logose">
                
                <img style="margin-left:374px" class="main_img1_logos" src="img/main11.png"/>    
                <img style="margin-left:690px" class="main_img1_logos" src="img/main22.png"/>
                <img style="margin-left:1030px" class="main_img1_logos" src="img/main33.png"/>
                <img style="margin-left:1330px" class="main_img1_logos" src="img/main4.png"/>

            
                

                <p>
            </div>

            <div style="position: relative;">
                <p class="tv">드라마/시리즈</p>
                           <p style="cursor: pointer;"class="plus" onclick="location.href='drama.php?bid=';">더보기 ></p>
                <p style="margin-top: 370px;" class="tv">영화</p>
                <p style="margin-top: 370px; z-index: 3;cursor: pointer;" class="plus" onclick="location.href='movie.php?bid=';"> 더보기 ></p>


                <script>
                    function move(type, check) {

                        if (check == 'up') {
                            var check = '.movies';
                        } else if (check == 'down') {
                            var check = check = '.movies2';
                        }
                        var tab = document.querySelector(check)
                        var marginLeft = window.getComputedStyle(tab).getPropertyValue('margin-left');
                        marginLeft = parseInt(marginLeft);
                        console.log(marginLeft);
                        if (type === 'right' && marginLeft != -612) {
                            var a = marginLeft - 204;
                            document.querySelector(check).style.marginLeft = a + 'px';
                            document.querySelector(check).style.transition = `${0.1}s ease-out`;

                        } else if (type === 'left' && marginLeft != 0) {
                            var a = marginLeft + 204;
                            document.querySelector(check).style.marginLeft = a + 'px';
                            document.querySelector(check).style.transition = `${0.1}s ease-out`;
                        }


                    }
                </script>
                <img onclick='move("left","up")' style="top: 981px;" class="left" src="img/left.png">
                <img onclick='move("right","up")' style="top: 981px;" class="right" src="img/right.png">
                <div style="top: 981px;	" class="show">
                    <div class="movies">

                        <?php
	$pxs=0;

	$query3 = $db->query("SELECT *  , GROUP_CONCAT(genres.genres_name) AS genrs_names  from tv left join genres ON tv.genre_id LIKE  CONCAT('%',genres.genre_id,'%')   group by tv.id ORDER BY tv.popularity desc
   limit 0,9"); 

	while ($row = $query3->fetch()) {

	?>

                        <div class="banner_img" style="margin-left:<?=$pxs?>px;" onclick="location.href='choice.php?choice=tv&id=<?=$row['id'];?>';">
                            <img style="height: 270px;" src="https://image.tmdb.org/t/p/w220_and_h330_face<?=$row['poster_path'];?>">
							<p style="text-align:center; top:0px;margin:10px; " 		class="hover_text"><?=$row['title']?></p>
                            <p style="top:60px; text-align:center; margin:10px;" class="hover_text"><?=$row['release_date']?></p>
                            <p style="top:100px;text-align:center; margin:10px;" class="hover_text"><?=$row['age']?></p>
                            <p style="top:150px;text-align:center; margin:10px;" class="hover_text"><?=$row['genrs_names']?></p>
							
                        </div>

                        <?php
$pxs=24;
}
?>
                    </div>
                </div>

                <img style="top:1350px" onclick='move("left","down")' class="left" src="img/left.png">
                <img style="top:1350px" onclick='move("right","down")' class="right" src="img/right.png">

                <div style="top:1350px" class="show">
                    <div class="movies2">

                        <?php
	$pxs=0;

	
	$query3 = $db->query("SELECT *   , GROUP_CONCAT(genres.genres_name) AS genrs_names  from movie left join genres ON movie.genre_id LIKE  CONCAT('%',genres.genre_id,'%')  group by movie.id ORDER BY movie.popularity desc
   limit 0,9"); 
	while ($row = $query3->fetch()) {

	?>

                        <div class="banner_img" style=" margin-left:<?=$pxs?>px;" onclick="location.href='choice.php?choice=movie&id=<?=$row['id'];?>';">
                               <img style="height: 270px;" src="https://image.tmdb.org/t/p/w220_and_h330_face<?=$row['poster_path'];?>">
							<p style="text-align:center; top:0px;margin:10px; " 		class="hover_text"><?=$row['title']?></p>
                            <p style="top:60px; text-align:center; margin:10px;" class="hover_text"><?=$row['release_date']?></p>
                            <p style="top:100px;text-align:center; margin:10px;" class="hover_text"><?=$row['age']?></p>
                            <p style="top:150px;text-align:center; margin:10px;" class="hover_text"><?=$row['genrs_names']?></p>
							
                        </div>

<?php
$pxs=24;
}
?>
                    </div>
                </div>
            </div>
            <div style="margin: 1750px 0px 0px;"></div>
<footer class="footer">
<p class="footer_text">© https://movieverse.cafe24.com/html/index.php |  소개 : NETFLIX(넷플릭스) | Disnep+(디즈니플러스) | 왓챠플레이<br>
Data & Content Image Based On Netflix.inc , Disnep.inc, Watcha.inc,JestWatch(c)<br><br>

성남시 중원구 광명로 377(금광2동 2685) 신구대학교 남관212호<br>
제안 또는 광고문의 : movieverse123@naver.com </p>
</footer>

</body>

</html>