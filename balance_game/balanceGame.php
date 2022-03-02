<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/new/common/Common.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/new/common/StringUtil.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/new/common/DBUtil.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/new/common/FileUtil.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/new/common/Logger.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/new/sms/smsProc.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/nm/common/FrontCommon.php");
?>
<!DOCTYPE html>
<html class="no-js" lang="ko">

<head>
  <?
  require_once($_SERVER["DOCUMENT_ROOT"] . "/nm/common/meta_k.php");
  ?>
  <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
  <script>
    $(document).ready(function() {
      show(18);

      $('input[type="checkbox"][id="check1"]').click(function() {
        if ($(this).prop('checked')) {
          $('input[type="checkbox"][id="check1"]').prop('checked', false);
          $(this).prop('checked', true);
        }
      });
      $('input[type="checkbox"][id="check2"]').click(function() {
        if ($(this).prop('checked')) {
          $('input[type="checkbox"][id="check2"]').prop('checked', false);
          $(this).prop('checked', true);
        }
      });
      $('input[type="checkbox"][id="check3"]').click(function() {
        if ($(this).prop('checked')) {
          $('input[type="checkbox"][id="check3"]').prop('checked', false);
          $(this).prop('checked', true);
        }
      });
      $('input[type="checkbox"][id="check4"]').click(function() {
        if ($(this).prop('checked')) {
          $('input[type="checkbox"][id="check4"]').prop('checked', false);
          $(this).prop('checked', true);
        }
      });
      $('input[type="checkbox"][id="check5"]').click(function() {
        if ($(this).prop('checked')) {
          $('input[type="checkbox"][id="check5"]').prop('checked', false);
          $(this).prop('checked', true);
        }
      });
    });

    function totalIt() {
      var input = document.getElementsByName("product");
      var total = 0;
      for (var i = 0; i < input.length; i++) {
        if (input[i].checked) {
          total += parseFloat(input[i].value);
          if (total > 100) {
            alert("100점을 초과하였습니다. 체크 해제 후 다시 선택해 주세요.");
          }
        }
      }
      document.getElementsByName("total")[0].value = total;
    }
    // 페이지 show 보여주기
    function show(idx) {
      idx = idx - 1;
      $('section').hide();
      $('section:eq(' + idx + ')').show();
    }

    var resultIdx = null;

    function result(r) {
      if (r == 'A') {
        resultIdx = 14;
        $('input[name=etc]').val(" ※결과 : 0~20%");
      } else if (r == 'B') {
        resultIdx = 15;
        $('input[name=etc]').val(" ※결과 : 30~50%");
      } else if (r == 'C') {
        resultIdx = 16;
        $('input[name=etc]').val(" ※결과 : 60~80%");
      } else {
        resultIdx = 17;
        $('input[name=etc]').val(" ※결과 : 90~100%");
      }
      show(13);
    }

    function success() {
      $('#frm').get(0).reset();
      show(resultIdx);
    }
  </script>
  <style>
    /* 체크된 값 색깔 변경 */
    input:checked+label {
      color: red;
    }

    .select {
      padding: 15px 10px;
    }

    .select input[type=radio] {
      display: none;
    }

    .select input[type=radio]+label {
      display: inline-block;
      cursor: pointer;
      height: 70px;
      width: 35%;

      border: 1px solid #333;
      line-height: 70px;
      text-align: center;
      font-weight: bold;
      font-size: 13px;
    }

    .select input[type=radio]+label {
      background-color: #fff;
      color: #333;
    }

    .select input[type=radio]:checked+label {
      background-color: #333;
      color: #fff;
    }
  </style>.
  <!-- 사이드바 -->
  <style>
    #sidebar {
      margin: 0pt;
      padding: 0pt;
      position: absolute;
      right: 0px;
      top: 0px;
    }
  </style>
  <script type="text/javascript">
    var stmnLEFT = 50; // 오른쪽 여백 
    var stmnGAP1 = 0; // 위쪽 여백 
    var stmnGAP2 = 150; // 스크롤시 브라우저 위쪽과 떨어지는 거리 
    var stmnBASE = 150; // 스크롤 시작위치 
    var stmnActivateSpeed = 35; //스크롤을 인식하는 딜레이 (숫자가 클수록 느리게 인식)
    var stmnScrollSpeed = 20; //스크롤 속도 (클수록 느림)
    var stmnTimer;

    function RefreshStaticMenu() {
      var stmnStartPoint, stmnEndPoint;
      stmnStartPoint = parseInt(document.getElementById('sidebar').style.top, 10);
      stmnEndPoint = Math.max(document.documentElement.scrollTop, document.body.scrollTop) + stmnGAP2;
      if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1;
      if (stmnStartPoint != stmnEndPoint) {
        stmnScrollAmount = Math.ceil(Math.abs(stmnEndPoint - stmnStartPoint) / 15);
        document.getElementById('sidebar').style.top = parseInt(document.getElementById('sidebar').style.top, 10) + ((stmnEndPoint < stmnStartPoint) ? -stmnScrollAmount : stmnScrollAmount) + 'px';
        stmnRefreshTimer = stmnScrollSpeed;
      }
      stmnTimer = setTimeout("RefreshStaticMenu();", stmnActivateSpeed);
    }

    function InitializeStaticMenu() {
      document.getElementById('sidebar').style.right = stmnLEFT + 'px'; //처음에 오른쪽에 위치. left로 바꿔도.
      document.getElementById('sidebar').style.top = document.body.scrollTop + stmnBASE + 'px';
      RefreshStaticMenu();
    }
  </script>
</head>

<body onload="InitializeStaticMenu();">
  <div class="wrap">
    <section id="lovetest">
      <div>
        <center>
          <input type='text' name='sell3' id='sell3'>
          <span>
            <button type="button" onclick="history.back();">이전</button>
            <button type="button" onclick="show(2);">다음</button>
          </span>
          <div style="padding-bottom: 100px;"></div>
        </center>
      </div>
      <!-- <ul>
        <li><a href="javascript:;" onclick="show(2);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
        <li><a href="javascript:;" onclick="show(5);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
      </ul> -->

    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>컴퓨터나 TV앞에 앉아 있는 시간이 부쩍 많아졌다</h3>
          <ul>
            <li><a href="javascript:;" onclick="show(3);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="show(9);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>혼자서 할 수 있는 운동이나 문화생활을 즐긴다</h3>
          <ul>
            <li><a href="javascript:;" onclick="result('A');"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="show(4);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>술자리나 모임이 잦고 사람들과 어울리는 자리를 찾는다</h3>
          <ul>
            <li><a href="javascript:;" onclick="result('C');"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="show(10);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>


    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>가끔씩 애인이 생기면 하고 싶은 일들을 생각해본다</h3>
          <ul>
            <li><a href="javascript:;" onclick="show(6);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="show(8);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>연예인이나 드라마, 만화속 주인공 등 비현실적인 인물에 열광하는 경우가 많다</h3>
          <ul>
            <li><a href="javascript:;" onclick="show(7);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="result('B');"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>심심한 것을 견딜 수 없고 혼자 있는 시간이 무료하다 못해 화가난다</h3>
          <ul>
            <li><a href="javascript:;" onclick="show(10);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="result('A');"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>쇼핑으로 스트레스를 푸는 버릇이 생겼다</h3>
          <ul>
            <li><a href="javascript:;" onclick="show(9);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="show(6);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>커플인 친구들이 부럽고 그 속에서 가끔 외로움을 느낀다</h3>
          <ul>
            <li><a href="javascript:;" onclick="result('C');"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="result('B');"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>재미있는 일, 재미없는 일에 대한 구분이 모호해져 특별한 일을 계획하지 않는다</h3>
          <ul>
            <li><a href="javascript:;" onclick="show(12);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="show(11);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>휴일이나 긴 휴가기간이 돌아오면 적극적으로 계획을 세운다</h3>
          <ul>
            <li><a href="javascript:;" onclick="show(12);"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="result('B');"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType03.png" alt="" /></h2>
        <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
        <div class="quiz-box a">
          <h3>남의 연애담을 잘 들어주고 상담해주는 것을 좋아한다</h3>
          <ul>
            <li><a href="javascript:;" onclick="result('D');"><input type="image" src="../../static/images/lovetest/bloodType/btn-yes.png" alt="" /></a></li>
            <li><a href="javascript:;" onclick="show(9);"><input type="image" src="../../static/images/lovetest/bloodType/btn-no.png" alt="" /></a></li>
          </ul>
        </div>
        <p class="line">
          <img src="../../static/images/lovetest/bloodType/bg-line.gif" alt="" />
          <a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType01.png" alt="" /></a>
        </p>
      </div>
    </section>


    <section id="lovetest">
      <form id="frm" name="frm" method="post">
        <input type="hidden" name="counselGbn" value="<?= getParam("counselGbn", "10066") ?>" />
        <input type="hidden" name="marriage" value="10501" />
        <input type="hidden" id="name" name="name">
        <input type="hidden" id="gender" name="gender">
        <input type="hidden" id="birthday" name="birthday">
        <input type="hidden" id="area" name="area">
        <input type="hidden" id="phone" name="phone">
        <input type="hidden" id="email" name="email">
        <input type="hidden" name="etc" id="etc" />
        <input type="hidden" name="user_id" id="user_id" />
        <div class="bloodType">
          <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType07.png" alt="" /></h2>
          <p class="line" style="margin-top:-15px;"><img src="../../static/images/lovetest/bloodType/bg-line2.png" alt="" /></p>
          <div class="input-box">

          </div>
          <div class="btn-group">
            <img src="/under/img/kakao_btn.png" alt="" onclick="javascript:kakaoGetData();" />
          </div>
        </div>

        <iframe src="" id="counselResult" name="counselResult" width="0" height="0" style="display:none;" frameborder="0"></iframe>
    </section>


    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType06.png" alt="" /></h2>
        <div class="result-box">
          <p class="tc"><img src="../../static/images/lovetest/bloodType/img-result01.gif" alt="" /></p>
          <p>사랑이고 뭐고 만사가 귀찮은 당신. 한때는 외로움도 많이 타고 애인이 생겼으면 좋겠다고 바란 적도 있었지만 다 옛날 얘기같이 느껴진다. 커플인 친구들에게 둘러싸여 있어도 스트레스를 받지 않으며, 친구들이 모임에 끼워주지 않아도 관대하게 이해하고 혼자 있는 시간을 즐기려고 한다.<br /><br />
            애인이 없다고 초라한 것은 아니라며 스스로를 위안하는 시간이 늘어나고, 혼자인 것에 대한 자기합리화에 이어 이 정도면 정말 혼자 살 수 있지 않을까 하는 용감무쌍한 생각까지 하게 된다. 멋진 싱글이 되기위해 공부나 일에 집착하려고 하지만 도무지 행동에 옮기지 못하고 화려한 싱글 생활을 꿈만 꾸는 당신.<br /><br />
            현재 메마를대로 메마른 감정 상태에 여유로운 척 자리 보존하고 있는 것이 가장 큰 문제.<br />
            로맨틱 영화나 주위의 커플들을 보고 자극을 받는 것이 러브지수를 올리는 시작이 될 것이다. <br />
            다음 단계는 당신에게 새로운 열정을 심어줄 상대를 찾는 것. 누군가를 만나려고 노력하는 단계는 이미 지났고 어떻게 노력을 해야 할지도 모르는 상태이므로 연인보다는 일단 친구를 만날 수 있는 기회를 만들어본다.<br />
            동호회에 가입하거나 친구들이나 지인을 통해서 다양한 사람을 많이 만나보고 편하게 지내며 상대방의 매력을 찾아보자.<br />
            영화를 보고 자극받았다고 해서 운명적 사랑을 무작정 기다리는 것은 금물. <br />
            그로 인해 당신이 이 지경까지 오게 됐을지도 모른다는 사실을 항상 인지하고 열린 마음으로 (바람둥이들이 자주 쓰는 표현이기도 하다) 이성을 대하는 것이 중요하다</p>
        </div>
        <p class="btn"><a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType02.png" alt="" /></a></p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType06.png" alt="" /></h2>
        <div class="result-box">
          <p class="tc"><img src="../../static/images/lovetest/bloodType/img-result02.gif" alt="" /></p>
          <p>
            언젠가는 누군가를 만날 것 같다는 확신이 있지만 현재 연인의 부재에 약간은 불안하고 외로운 당신. <br />
            주위에서 소개팅이라도 주선할라치면 ‘만나볼까?’, ‘귀찮아!’ 사이에서 고민한다. <br />
            커플을 부러워하는 경우가 종종 있으며 가끔 커플들 사이에서 소외감을 느끼기도 한다. <br /><br />

            하지만 자신이 좋아하는 일에 집중하면 모든 근심걱정이 사라지므로 몸을 힘들게 만들려고 노력하는 형이다.<br />
            누군가를 만나고 싶은 욕심은 있지만 언젠가는 자신에게 맞는 상대가 저절로 나타날 것이라는 허황된 꿈을 안고 사는 덕에 웬만한 이성은 눈에 차지 않는다. 사람을 만날 때 이것저것 따지는 것이 많고 사랑 앞에 강한 척하는 것이 특징이다.<br /><br />

            한마디로 속 다르고 겉 다른 형. 이런 유형의 사람들에게 가장 위험한 것은 자포자기로 발전할 가능성은 크다. <br />
            가장 먼저 해야 할 일은 자신에게 맞는 상대가 어떤지 체크해보는 것. 내가 만나고 싶은 사람, 정말 기피하고 싶은 사람, 이성을 볼 때 가장 중요하게 생각하는 것, 현재 주위에 있는 사람들에 대한 호감도 등 연애를 하기위한 준비를 꼼꼼히 해본다.<br /><br />

            여행지나 놀거리를 살피며 애인과 하고 싶은 일들을 생각해보는 것도 러브지수를 충만하게 해줄 수 있는 좋은 방법이다.<br />
            누군가가 옆에 있었으면 좋겠다는 인식은 충분히 하고 있는 상태이므로 조금만 불을 지펴주면 다음부터는 일사천리로 진행된다.<br /><br />

            이런 사람들이 사랑하는 사람을 만나면 가장 성실하고 오래간다.
          </p>
        </div>
        <p class="btn"><a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType02.png" alt="" /></a></p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType06.png" alt="" /></h2>
        <div class="result-box">
          <p class="tc"><img src="../../static/images/lovetest/bloodType/img-result03.gif" alt="" /></p>
          <p>
            러브필이 충만한 당신. <br />
            누군가가 옆에 있었으면 하는 생각을 수시로 하며 길거리를 지나다 괜찮은 이성을 보면 눈을 떼지 못한다.<br />
            못 먹는 감이라도 어떻게 안될까 호시탐탐 노리기도 하지만 생각에 그치는 것이 어찌 보면 다행. <br /><br />

            남의 연애담 듣기를 좋아하며 내가 이 상황이라면 이렇게 했을 것이라는 충고에 열 올리기도 한다. <br />
            하지만 정작 자신은 내실이 없다. 이렇게 러브필이 충만한데도 결실이 없는 사람들의 가장 큰 문제는 이리재고 저리 재는 버릇이다.<br />
            처음 소개받을 때는 ‘이러면 어떻고 저러면 어떠니’라고 말하면서도 ‘아무나 만날 순 없잖아’를 입버릇처럼 내뱉으며 사람을 내치는 나쁜 습성도 있다.<br />
            영혼이 통하는 사람, 혹은 조건이 딱 맞는 사람을 원하는 통에 시작도 해보기 전에 지레 안 된다고 결단 내리는 경우가 많다.<br /><br />

            혹은 반대로 상대방이 마음에 들어도 자신을 내 보이길 쑥스러워 하는 경우가 있다. <br />
            이런 유형들은 1차적으로 철저한 자기 분석이 필요하다. 나는 현재 어떤 생각을 하고있고 어떤 위치에 있으며 남들에게 보이는 나는 어떨까를 생각하며 자만심을 버리거나 자신감을 채워야 한다.<br />
            ‘그동안 너무 나 자신을 과대평가했군’ 혹은 ‘나도 꽤 괜찮은 사람이었어’라고 생각할 수 있다면 자신과 맞는 사람을 좀더 쉽게 만날 수 있다. 여러 이성들에게 가능성을 열어두고 사랑할 기회를 호시탐탐 노리는 당신의 모습은 그대로 가져가되 현실적인 자기 파악에 들어가보자는 말씀.
          </p>
        </div>
        <p class="btn"><a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType02.png" alt="" /></a></p>
      </div>
    </section>

    <section id="lovetest">
      <div class="bloodType">
        <h2 class="title"><img src="../../static/images/lovetest/bloodType/title-bloodType06.png" alt="" /></h2>
        <div class="result-box">
          <p class="tc"><img src="../../static/images/lovetest/bloodType/img-result04.gif" alt="" /></p>
          <p>
            사랑할 준비도, 확실하게 타오를 준비도 확실히 돼 있는 당신. 그런데 왜 애인이 없는 걸까? <br />
            과도한 에너지가 문제일 수 있다. 사람과 사람이 만나면, 특히 호감 가는 사람들끼리 마주하면 일종의 전파 같은 것이 흐르는데 그것으로 이 사람이 나에게 얼마나 관심이 있는지 무관심한지 알 수 있다고 한다.<br />
            좋은 티 팍팍 내는 당신, 말하지 않아도 얼굴에 사랑에 빠졌다고 써 있다.<br /><br />

            누군가에게 빠지는 것을 나쁘다고 할 수만은 없다. <br />
            문제는 그런 감정이 자주 일어난다는 것. 애정이 흘러넘치다 보니 이 사람 저 사람 건드리다가 한 명도 못 건지는 불상사가 일어나기도 한다. 열정적인 연애를 하지 못하는 상황이라면 보험적인 의미로라도 이성을 곁에 두었으면 좋겠다는 당신의 욕심은 자칫 당신을 한없이 외롭게 만들 수도 있다.<br /><br />

            이런 유형에게 가장 필요한 것은 상대를 만났을 때 느끼는 감정이 진짜 사랑인지 가슴에 손을 얹고 냉정하게 판단해보는 것. 얘를 만나면 이래서 좋고 쟤를 만나면 저래서 좋다는 공식은 사랑하는 사람을 만드는 공식에 적용되지 않는다.<br /><br />

            또 하나, 사랑에 충만한 사람일수록 외로움도 많이 탄다는 사실. 옆에 누군가가 없으면 우울증에 걸리기 십상이므로.
          </p>
        </div>
        <p class="btn"><a href="bloodType.php"><img src="../../static/images/lovetest/bloodType/btn-bloodType02.png" alt="" /></a></p>
      </div>
    </section>

    <!-- 첫번째 화면 -->
    <section id="lovetest" style="margin: 20px;">
      <center>
        <p style="font-size: 30px;">나의 100점짜리<br> 남편 만들기</p><br /><br />
      </center>
      <!-- 1. 재력 -->
      <div>
        <p style="font-size: 20px;">1. 재력</p>
        <input name="product" id="check1" value="30" type="checkbox" onclick="totalIt()" /><label for="check1">1) 1층에 스타벅스가 입점한 건물주 -30점</label>
        <br>
        <input name="product" id="check1" value="25" type="checkbox" onclick="totalIt()" /><label for="check1">2) 부모님 노후 준비 완료, 아파트 1채 증여 가능 -25점</label>
        <br>
        <input name="product" id="check1" value="20" type="checkbox" onclick="totalIt()" /><label for="check1">3) 본인 명의 아파트 소유 (대출 포함) -20점</label>
        <br>
        <input name="product" id="check1" value="15" type="checkbox" onclick="totalIt()" /><label for="check1">4) 결혼자금 5,000만원 보유 -15점</label>
        <br>
        <input name="product" id="check1" value="10" type="checkbox" onclick="totalIt()" /><label for="check1">5) 마이너스 통장 소유 -10점</label>
        <br>
      </div><br />
      <!-- 2. 외모 -->
      <div>
        <p style="font-size: 20px;">2. 외모</p>
        <input name="product" id="check2" value="30" type="checkbox" onclick="totalIt()" /><label for="check2">1) 이상형 -30점</label>
        <br>
        <input name="product" id="check2" value="25" type="checkbox" onclick="totalIt()" /><label for="check2">2) 누가봐도 잘생김 -25점</label>
        <br>
        <input name="product" id="check2" value="20" type="checkbox" onclick="totalIt()" /><label for="check2">3) 지나가는 행인2 -20점</label>
        <br>
        <input name="product" id="check2" value="15" type="checkbox" onclick="totalIt()" /><label for="check2">4) 화가날 때 보면 더 화가 남 -15점</label>
        <br>
        <input name="product" id="check2" value="10" type="checkbox" onclick="totalIt()" /><label for="check2">5) 니 남친 지나간다ㅋㅋㅋ -10점</label>
        <br>
      </div><br />
      <!-- 3. 성격 -->
      <div>
        <p style="font-size: 20px;">3. 성격</p>
        <input name="product" id="check3" value="30" type="checkbox" onclick="totalIt()" /><label for="check3">1) 다정다감 가정적 -30점</label>
        <br>
        <input name="product" id="check3" value="25" type="checkbox" onclick="totalIt()" /><label for="check3">2) 먼저 사과할 줄 아는 사람 -25점</label>
        <br>
        <input name="product" id="check3" value="20" type="checkbox" onclick="totalIt()" /><label for="check3">3) 모나지 않은 사람 -20점</label>
        <br>
        <input name="product" id="check3" value="15" type="checkbox" onclick="totalIt()" /><label for="check3">4) 집착이 심한 성격 -15점</label>
        <br>
        <input name="product" id="check3" value="10" type="checkbox" onclick="totalIt()" /><label for="check3">5) 남을 무시하는 사람 -10점</label>
        <br>
      </div><br />
      <!-- 4. 대화 -->
      <div>
        <p style="font-size: 20px;">4. 대화</p>
        <input name="product" id="check4" value="30" type="checkbox" onclick="totalIt()" /><label for="check4">1) 그냥 공감해주는게 아니라 진짜 귀 담아 듣는 사람 -30점</label>
        <br>
        <input name="product" id="check4" value="25" type="checkbox" onclick="totalIt()" /><label for="check4">2) 힘든일이 있어도 같이 대화하면 풀어지는 사람 -25점</label>
        <br>
        <input name="product" id="check4" value="20" type="checkbox" onclick="totalIt()" /><label for="check4">3) 객관적이지만 내 편이 아닐 때 서운 -20점</label>
        <br>
        <input name="product" id="check4" value="15" type="checkbox" onclick="totalIt()" /><label for="check4">4) 말을 할 때 중학교 때 말투를 아직도 갖고있는 사람 ex) 존나,ㅅㅂ -15점</label>
        <br>
        <input name="product" id="check4" value="10" type="checkbox" onclick="totalIt()" /><label for="check4">5) 대화가 이어지지 않는 사람 -10점</label>
        <br>
      </div><br />
      <!-- 5. 친구 -->
      <div>
        <p style="font-size: 20px;">5. 친구</p>
        <input name="product" id="check5" value="30" type="checkbox" onclick="totalIt()" /><label for="check5">1) 친한 친구들이 모두 사랑꾼 -30점</label>
        <br>
        <input name="product" id="check5" value="25" type="checkbox" onclick="totalIt()" /><label for="check5">2) 친구 관계가 좁고 깊은 사람 -25점</label>
        <br>
        <input name="product" id="check5" value="20" type="checkbox" onclick="totalIt()" /><label for="check5">3) 친구가 나 밖에 없는 사람 -20점</label>
        <br>
        <input name="product" id="check5" value="15" type="checkbox" onclick="totalIt()" /><label for="check5">4) 주말마다 술 먹자고 연락하는 친구가 많은 사람 -15점</label>
        <br>
        <input name="product" id="check5" value="10" type="checkbox" onclick="totalIt()" /><label for="check5">5) 연락하는 이성친구가 많은 사람 -10점</label>
        <br>
      </div><br />

      <div class="sidebar" id="sidebar" style="background-color: #dcdcdc; padding-left:10px; font-weight:bold;">
        합계 : <input value="0" readonly="readonly" type="text" name="total" style="border: none; background-color: #dcdcdc; width:30px; font-weight: bold;" />
      </div>


    </section>


  </div>
  </form>
</body>

</html>