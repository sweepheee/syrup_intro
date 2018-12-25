<?php
$db_host = "localhost";
$db_user = "sc2syrup";
$db_passwd = "tmdgml65";
$db_name = "sc2syrup";

$conn = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>sc2 SYRUP CLAN</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/fullpage.min.css">
  <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
<script>
    var userAgent=navigator.userAgent.toLowerCase();
    var agent = navigator.userAgent.toLowerCase();
    if ( (navigator.appName == 'Netscape' && agent.indexOf('trident') != -1) || (agent.indexOf("msie") != -1)) {
     // ie일 경우
     alert("인터넷익스플로러, 엣지브라우저, 사파리는 지원하지않습니다. 크롬, 오페라, 웨일브라우저에 최적화되어 있습니다.");
   }

   if(userAgent.indexOf('edge')>-1){

	alert("인터넷익스플로러, 엣지브라우저, 사파리는 지원하지않습니다. 크롬, 오페라, 웨일브라우저에 최적화되어 있습니다.");

}

  </script>
</head>
<body>
  <nav>
    <div class="navImg"><a href="#welcome"><img src="img/bunker.png" alt=""></a></div>
    <div class="navBoard"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#1040e2"/><path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z"/></svg></div>
    <ul>
      <li><a href="#contentsAnchor"><img src="img/syrup.svg" alt="" width="50px"></a></li>
      <li><a href="#practiceAnchor"><img src="img/game-controller.svg" alt="" width="50px"></a></li>
      <li><a href="#joinAnchor"><img src="img/agreement.svg" alt="" width="50px"></a></li>
    </ul>
  </nav>
  <div class="board boardOpen">
    <div class="board-bg">
      <div class="in-board">
        <div class="board__title"><span><img src="img/question.svg" width="55px;" />   잡담, 기록, 비매너제보</span></div>
          <div class="board__board">
            <table>
              <tr>
                <th>No</th>
                <th style="width: 50%">제목</th>
                <th>작성자</th>
                <th>작성일</th>
              </tr>
                <?php


              $sql = "SELECT * FROM ask_board order by bno desc limit 10;";

              if ($result = mysqli_query($conn,$sql)){


              while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>" . $row['bno'] . "</td>";
              echo "<td><a id=Bno_". $row['bno'] ." class='bnoValidate' onclick='viewContents(". $row['bno'] .")' >" . htmlspecialchars($row['title']) . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['date'] . "</td>";
              echo "</tr>";
              }

              } else {
              echo "테이블 쿼리 오류: " . mysqli_error($conn);
              exit;

              }
              ?>
            </table><br />
            <div class="boardCntSpace">
              <?php
              $sql_bno = "SELECT count(bno) FROM ask_board";

              if ($view = mysqli_query($conn,$sql_bno)){

                $resultaa = mysqli_fetch_row($view);

                if($resultaa[0]%10==0) {
                  $board_cnt = $resultaa[0]/10;
                }else {
                  $board_cnt = floor($resultaa[0]/10+1);
                }

                for($i=$board_cnt; $i>=1; $i--) {
                  echo "<a onclick='boardPage_cnt(" . $i . ")'>". $i . "&nbsp;&nbsp;</a>";
                }

                } else {
                echo "테이블 쿼리 오류: " . mysqli_error($conn);
                exit;
                }

               ?>
               <button class="board_write_btn">글쓰기</button>
            </div>
          </div>
          <div class="board__board board__board2nd displayNone">
            <table id="board_table">
              <thead>
              <tr>
                <th>No</th>
                <th style="width: 50%">제목</th>
                <th>작성자</th>
                <th>작성일</th>
              </tr>
              </thead>
              <tbody>
              </tbody>
            </table><br />
            <div class="boardCntSpace">
              <?php
              $sql_bno = "SELECT count(bno) FROM ask_board";

              if ($view = mysqli_query($conn,$sql_bno)){

                $resultaa = mysqli_fetch_row($view);

                if($resultaa[0]%10==0) {
                  $board_cnt = $resultaa[0]/10;
                }else {
                  $board_cnt = floor($resultaa[0]/10+1);
                }

                for($i=$board_cnt; $i>=1; $i--) {
                  echo "<a onclick='boardPage_cnt(" . $i . ")'>". $i . "&nbsp;&nbsp;</a>";
                }

                } else {
                echo "테이블 쿼리 오류: " . mysqli_error($conn);
                exit;
                }

               ?>
               <button class="board_write_btn board_write_btn2">글쓰기</button>
            </div>
          </div>
          <div class="board__write displayNone">
            <table>
              <form id="writeForm">
              <tr>
                <td>글 제목</td>
                <td colspan="3"><input type="text" name="title" id="title" style="width:750px; height: 30px; background-color: transparent; border:none; border-bottom: 1px solid gray;"></td>
              </tr>
              <tr>
                <td>작성자</td>
                <td><input type="text" name="name" id="name" style="width:300px; height: 30px;  background-color: transparent; border:none; border-bottom: 1px solid gray;"></td>
                <td>비밀번호</td>
                <td><input type="password" name="password" id="password" style="width:300px; height: 30px; background-color: transparent; border:none; border-bottom: 1px solid gray;"></td>
              </tr>
              <tr>
                <td colspan="4"><textarea name="contents" id="contents" cols="115" rows="30" style="margin-top: 20px; resize: none;"></textarea></td>
              </tr>
            <button type="button" class="write__action" onclick="write_submit()">작성하기</button>
            <button type="button" class="write__cancel">취소</button>
            </form>
          </table>
          </div>

          <script>
            function write_submit() {

              var write_form = $("#writeForm").serialize();

              $.ajax({
                url : "dbtext.php",
                data: write_form,
                type: "post",
                success : function() {
                  alert("글을 등록했습니다.");
                  location.reload();
                }
              });

            }
          </script>

          <div class="board__view displayNone">
            <table>
              <tr>
                <td style="color: #7f8c8d;">제목</td>
                <td colspan='3'><div name='board_view_Title' class='board_view_Title' style='width:710px; height: 30px; background-color: transparent; border:none; border-bottom: 1px solid gray; text-align: left;'></div></td>
              </tr>
              <tr>
                <td style="color: #7f8c8d;">작성자</td>
                <td><div name='board_view_name' class='board_view_name' style='width:295px; height: 30px;  background-color: transparent; border:none; border-bottom: 1px solid gray;'></div></td>
                <td style="color: #7f8c8d;">작성일</td>
                <td><div name='board_view_date' class='board_view_date' style='width:295px; height: 30px; background-color: transparent; border:none; border-bottom: 1px solid gray;'></div></td>
              </tr>
              <tr>
                <td colspan='4'><div name='board_view_contents' class='board_view_contents' style='margin-top: 20px; overflow:auto; background-color: white; width:800px; height: 500px;'></div></td>
              </tr>
            <button type="submit" class="view__modify">수정하기</button>
            <button type="button" class="view__cancel" onclick="view_list_back()">이전</button>
          </table>
          </div>

          <script>

            var boardView = document.querySelector(".board__view");
            var boardBoard = document.querySelector(".board__board");
            var pageBoard = document.querySelector(".board__board2nd");


            function viewContents(n) {
              var nn = n;
              $.ajax({
                url : "boardView.php",
                data : {bno : nn},
                type : "post",
                success : function(result) {
                  var dt_random = $.parseJSON(result);
                  var replaceTitle = dt_random.title.replace("<", "&lt;").replace(">", "&gt;");
                  var replaceContents = dt_random.contents.replace(/(\n|\r\n)/g, '<br>');
                  boardView.classList.remove("displayNone");
                  boardBoard.classList.add("displayNone");
                  pageBoard.classList.add("displayNone");
                  $(".board_view_Title").text(replaceTitle);
                  $(".board_view_name").text(dt_random.name);
                  $(".board_view_date").text(dt_random.date);
                  $(".board_view_contents").html(replaceContents);
                },
                error : function() {
                  alert("에러!");
                }
              });
            }

            function view_list_back() {
              boardView.classList.add("displayNone");
              boardBoard.classList.remove("displayNone");
            }

            function boardPage_cnt(n) {
              $.ajax({
                url: "boardListCnt.php",
                data: {listPage : n},
                type: "post",
                success: function(result) {
                  var res = $.parseJSON(result);
                  pageBoard.classList.remove("displayNone");
                  boardBoard.classList.add("displayNone");
                  $('#board_table > tbody:last > tr').remove();
                  for(var i = 0; i <= res.length; i++) {
                    $('#board_table > tbody:last').append('<tr><td>'+ res[i].bno+ '</td><td><a id=Bno_'+res[i].bno+' class=bnoValidate onclick=viewContents('+res[i].bno+') >'+ res[i].title.replace("<","&lt;").replace(">", "&gt;") +'</td><td>'+ res[i].name.replace("<","&lt;").replace(">", "&gt;") + '</td><td>'+ res[i].date+ '</td></tr>');
                }
                }
              });
            }
          </script>



      </div>
    </div>
  </div>

  <script>
    var dnone = "boardOpen";
    const boardOpen = document.querySelector(".navBoard");
    const boarda = document.querySelector(".board");
    const goWritePage = document.querySelector(".board_write_btn");
    const goWritePage2 = document.querySelector(".board_write_btn2");
    const writePage = document.querySelector(".board__write");
    const boardListPage = document.querySelector(".board__board");
    const boardListPage2 = document.querySelector(".board__board2nd");
    const write__cancel = document.querySelector(".write__cancel");

    boardOpen.onclick = function() { boardOpened() }
    goWritePage.onclick = function() { WAOpen() }
    goWritePage2.onclick = function() { WAOpen() }
    write__cancel.onclick = function() { writeCancel() }

    function boardOpened() {
      const currentBoardOpen = document.querySelector(".boardOpen");
      if(currentBoardOpen){
        boarda.classList.remove(dnone);
      }else {
        boarda.classList.add(dnone);
      }
    }

    function WAOpen() {
      writePage.classList.remove("displayNone");
      boardListPage.classList.add("displayNone");
      boardListPage2.classList.add("displayNone");
    }

    function writeCancel() {
      writePage.classList.add("displayNone");
      boardListPage.classList.remove("displayNone");
    }
  </script>

<div id="fullpage">
  <div class="wrap section" data-anchor="welcome">
    <div class="intro">
      <div class="slider1">
        <p>Hello, SYRUP!</p>
        <span>시럽클랜에 오신걸 환영합니다!<br>시럽클랜은 연습게임 위주의 래더유저 클랜입니다.</span><br><br><Br><br>
        <a href="#joinAnchor"><button>가입문의</button></a>
      </div>
      <div class="slider">
        <div class="slider__item"><h1></h1></div>
        <div class="slider__item"><h1></h1></div>
        <div class="slider__item"><h1></h1></div>
        <div class="slider__item"><h1></h1></div>
        <div class="slider__item"><h1></h1></div>
      </div>
    </div>
  </div>
  <script>
    const SHOWING_CLASS = "showing";
    const firstSlide = document.querySelector(".slider__item:first-child");
    function slide() {
      const currentSlide = document.querySelector(`.${SHOWING_CLASS}`);
      if(currentSlide) {
        currentSlide.classList.remove(SHOWING_CLASS);
        const nextSlide = currentSlide.nextElementSibling;
        if(nextSlide) {
          nextSlide.classList.add(SHOWING_CLASS);
        }else {
          firstSlide.classList.add(SHOWING_CLASS);
        }
      }else {
        firstSlide.classList.add(SHOWING_CLASS);
      }
    }
    slide();
    setInterval(slide, 3000);
  </script>

  <div class="contents section" data-anchor="contentsAnchor">
    <div class="article ">
      <div class="show-on-scroll">
        <span class="farti__high">#CONTENTS</span>
        <p class="farti">연습게임과 커뮤니티 활성화!</p>
        <span class="farti__low">골플다 라이트유저 연습게임, 늘 시끄러운 카카오톡, 관리 고인물의 디스코드운영<br>같이 즐겨요!</span>
        <div class="contents__grid">
          <div class="contents__item"><div class="item__in"><p>연습게임</p></div></div>
          <div class="contents__item"><div class="item__in"><p>오픈채팅</p></div></div>
          <div class="contents__item"><div class="item__in"><p>디스코드</p></div></div>
        </div>
      </div>
    </div>
  </div>

  <div class="information section" data-anchor="practiceAnchor">
    <div class="infor__bg">
      <div class="infor">
        <span class="infor__text__high">#PRACTIVE</span><br><br><br>
        <span class="infor__text">라이트유저<br>연습게임</span><br><br><br>
        <span class="infor__text__low">클랜원의 대부분이 라이트유저로 <br>잡금이라도 연습게임에 참여해보세요!</span><br>
        <button class="inforBtn" onclick="ing()">보러 가기</button>
      </div>
    </div>
  </div>

  <script>
    function ing() {
      alert("준비중...");
    }
  </script>

  <div class="join section" data-anchor="joinAnchor">
    <div class="join__bg">
      <div class="join__slider">
        <div class="select__join">
          <div class="pros__item">
            <span class="pros__text__high">#JOIN</span><br><br><br><br>
            <span class="pros__text">회원가입하기</span><br>
            <span class="mobile_join_info"><a href=https://open.kakao.com/o/gj9tP3S>#카카오톡 오픈채팅 링크</a></span>
            <div class="select__container">
              <div class="select__items">
                <img src="img/discord.svg" alt="" width="350%"><br>
              </div>
              <div class="select__items">
                <img src="img/chat.svg" alt="" width="80%;"><br>
              </div>
              <div class="select__items">
                <img src="img/galaxy.svg" alt="" width="350%;">
              </div>
            </div>
            <div class="select__container select__container2 displayNone">
              <div class="select__items edge_select">
                <img src="img/discord.svg" alt="" width="180%"><br>
              </div>
              <div class="select__items edge_select">
                <img src="img/chat.svg" alt="" width="80%;"><br>
              </div>
              <div class="select__items edge_select">
                <img src="img/galaxy.svg" alt="" width="180%;">
              </div>
            </div>

          </div>
          <div class="join__dis">
            <div class="dis__items">
              <img src="img/discord1.png" alt="" width="1024px"><br><br>
              <span>디스코드를 <a href="https://discordapp.com/">다운로드</a>받습니다.<br><br>
                <button class="dis__btn" onclick="dis__next()">다음</button></span>
            </div>
            <div class="dis__items">
              <img src="img/discord3.png" alt="" width="950px"><br>
              <span>스탭 친구추가 후 가입문의주세요.<br>
                스탭 : 쿼파치#3762, 학처럼 날아올라라#6563, Hanu#5495, Stelle#5283, 메이로#7545<br>
                <br><button class="dis__btn" onclick="dis__back()">이전</button>
              <button class="dis__btn__reset" onclick="back__join()">처음으로</button></span>
            </div>
          </div>
          <div class="join__ka">
            <div class="ka__items">
              <img src="img/join_ka.png" alt="">
              <span class="jk_span_high"><a href=https://open.kakao.com/o/gj9tP3S>#카카오톡 오픈채팅 링크</a></span><br><br><br>
              <span class="jk_span_low">해당 카카오톡 오픈채팅은 오로지 <br>가입문의를 목적으로 개설되어 스탭들만 상주하고 있습니다.
              <br>친목질에 거부감이 있는 분이나 익명을 원하시는 분들<br>
                  모두 부담없이 문의해주세요.<br>
                <br><button class="dis__btn__reset" onclick="ka_reset()">처음으로</button></span>
            </div>
          </div>
          <div class="join__ingame">
            <div class="ingame__items">
              <img src="img/in1.jpg" alt="">
              <br><button onclick="igNext()" class="dis__btn">다음</button>
              <div class="back_to_first" onclick="back_to_first()">처<br>음<br>으<br>로</div>
            </div>
            <div class="ingame__items">
              <img src="img/in2.jpg" alt="" height="700px;"><br>
              <button onclick="igPrevious()" class="dis__btn">이전</button>&nbsp;<button onclick="igNext()" class="dis__btn">다음</button>
              <div class="back_to_first" onclick="back_to_first()">처<br>음<br>으<br>로</div>
            </div>
            <div class="ingame__items">
              <img src="img/in3.jpg" alt=""><br>
              <button onclick="igPrevious()" class="dis__btn">이전</button>&nbsp;<button onclick="igNext()" class="dis__btn">다음</button>
              <div class="back_to_first" onclick="back_to_first()">처<br>음<br>으<br>로</div>
            </div>
            <div class="ingame__items">
              <img src="img/in4.jpg" alt="" width="1024px"><br>
              <button onclick="igPrevious()" class="dis__btn">이전</button>&nbsp;<button onclick="igNext()" class="dis__btn">다음</button>
              <div class="back_to_first" onclick="back_to_first()">처<br>음<br>으<br>로</div>
            </div>
            <div class="ingame__items">
              <img src="img/bliz1.png" alt="" width="900px"><br>
              <button onclick="igPrevious()" class="dis__btn">이전</button>&nbsp;<button onclick="igNext()" class="dis__btn">다음</button>
              <div class="back_to_first" onclick="back_to_first()">처<br>음<br>으<br>로</div>
            </div>
            <div class="ingame__items">
              <img src="img/bliz2.png" alt="" width="900px" ><br>
              <button onclick="igPrevious()" class="dis__btn">이전</button>&nbsp;<button onclick="igNext()" class="dis__btn">다음</button>
              <div class="back_to_first" onclick="back_to_first()">처<br>음<br>으<br>로</div>
            </div>
            <div class="ingame__items">
              <img src="img/bliz3.png" alt="" width="500px"><br><button onclick="igPrevious()" class="dis__btn">이전</button>
              <div class="back_to_first" onclick="back_to_first()">처<br>음<br>으<br>로</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <script>
    const o1 = "opacity1";
    const o0 = "opacity0";
    const aniShow = "aniShow";
    const kaShow = "kaShow";
    const igShow = "igShow";
    const igUnShow = "igUnShow";
    const firstScreen = document.querySelector(".select__items:first-child");
    const secondScreen = document.querySelector(".select__items:nth-child(2)");
    const thirdScreen = document.querySelector(".select__items:nth-child(3)");
    const fourScreen = document.querySelector(".edge_select:first-child");
    const fiveScreen = document.querySelector(".edge_select:nth-child(2)");
    const sixScreen = document.querySelector(".edge_select:nth-child(3)");
    const container = document.querySelector(".pros__item");
    const disFirst = document.querySelector(".dis__items:first-child");
    const disSecond = document.querySelector(".dis__items:nth-child(2)");
    const kaFirst = document.querySelector(".ka__items");
    const ingame = document.querySelector(".ingame__items:first-child");
    const dis_next = document.getElementsByClassName("dis__next:first-child");
    console.log(firstScreen);

    firstScreen.onclick = function() {clicked()}
    secondScreen.onclick = function() {clicked2()}
    thirdScreen.onclick = function() {clicked3()}
    fourScreen.onclick = function() {clicked()}
    fiveScreen.onclick = function() {clicked2()}
    sixScreen.onclick = function() {clicked3()}

    function clicked() {
      const o1set = document.querySelector(".opacity1");
      if(o1set) {
        container.classList.remove(o1);
      }
      container.classList.add(o0);
      disFirst.classList.add(aniShow);
    }

    function clicked2() {
      const o1set = document.querySelector(".opacity1");
      if(o1set) {
        container.classList.remove(o1);
      }
      container.classList.add(o0);
      kaFirst.classList.add(kaShow);
    }

    function clicked3() {
      const o1set = document.querySelector(".opacity1");
      if(o1set) {
        container.classList.remove(o1);
      }
      container.classList.add(o0);
      ingame.classList.add(igShow);
    }



    function dis__next() {
      disFirst.classList.remove(aniShow);
      disSecond.classList.add(aniShow);
    }

    function dis__back() {
      disSecond.classList.remove(aniShow);
      disFirst.classList.add(aniShow);
    }

    function back__join() {
      disSecond.classList.remove(aniShow);
      container.classList.add(o1);
      setTimeout(function() {
        container.classList.remove(o0);
      }, 500);
    }

    function ka_reset() {
      kaFirst.classList.remove(kaShow);
      container.classList.add(o1);
      setTimeout(function() {
        container.classList.remove(o0);
      }, 500);
    }

    function igNext() {
      const currentIgNext = document.querySelector(`.${igShow}`);
      if(currentIgNext) {
        currentIgNext.classList.add(igUnShow);
        setTimeout(function() {
          currentIgNext.classList.remove(igShow);
          currentIgNext.classList.remove(igUnShow);
        }, 500);
        const nextIgNext = currentIgNext.nextElementSibling;
        if(nextIgNext) {
          nextIgNext.classList.add(igShow);
        }else {
          ingame.classList.add(igShow);
        }
      }else {
        ingame.classList.add(igShow);
      }
    }

    function igPrevious() {
      const currentIgNext = document.querySelector(`.${igShow}`);
      if(currentIgNext) {
        currentIgNext.classList.add(igUnShow);
        setTimeout(function() {
          currentIgNext.classList.remove(igShow);
          currentIgNext.classList.remove(igUnShow);
        }, 500);
        const previousIgNext = currentIgNext.previousElementSibling;
        if(previousIgNext) {
          previousIgNext.classList.add(igShow);
        }else {
          ingame.classList.add(igShow);
        }
      }else {
        ingame.classList.add(igShow);
      }
    }

    function back_to_first() {
      const currentIgNext = document.querySelector(`.${igShow}`);
      if(currentIgNext) {
        currentIgNext.classList.add(igUnShow);
        setTimeout(function() {
          container.classList.add(o1);
          currentIgNext.classList.remove(igShow);
          currentIgNext.classList.remove(igUnShow);
        }, 500);
      }
    }
  </script>

  <script>
    window.onload = function() {

      var first = document.querySelector(".select__items");
      var container = document.querySelector(".select__container");
      var noneSelect = document.querySelector(".select__container2");
      var none = "displayNone";

      if ( (navigator.appName == 'Netscape' && agent.indexOf('trident') != -1) || (agent.indexOf("msie") != -1)) {
       // ie일 경우
       container.classList.add(none);
       var mobile_join_info = document.querySelector(".mobile_join_info");
       mobile_join_info.classList.remove("mobile_join_info");
       mobile_join_info.classList.add("displayBlock");
     }


     if (/Edge/.test(navigator.userAgent)) {
       noneSelect.classList.remove(none);
       container.classList.add(none);
     }
    }
  </script>



  <script src="js/jquery-2.2.4.min.js"></script>
  <script src="js/fullpage.min.js"></script>
  <script>
    new fullpage("#fullpage", {
      navigation: true,
      responsiveWidth: 700,
      parallax: true,
      onLeave: function(origin, destination, direction) {
        console.log("Leaving section"+origin.index);
      }
    });
  </script>


</body>
</html>
