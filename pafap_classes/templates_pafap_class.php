
<?php

class pafap_templates
{
  public function show_cpr($site)
  {
  	print "Copyright &#169 ".date("Y")." $site ";
  }

  public function show_message($message, $class)
  {
    if ($message != '')
    {
      echo "<br>";
      echo "<div class='{$class}'>";
      foreach($message as $key=>$value)
      echo $value."<br>
      </div>";
    }
  }

  public function _show($class, $data)
  {
    echo "<div class='{$class}'>{$data}</div>";
  }
  public function _showWithId($id, $data)
  {
    echo "<div id='{$id}'>{$data}</div>";
  }

  public function parseURL($url)
  {
    $pattern = '/watch?.*?v=/i';
    return preg_match($pattern, $url);
  }

  public function EmbedVideo($url, $width = '80%', $height = 'auto')
  {
    return "<object width='{$width}' height='{$height}'><param name='movie' value='{$url}' value='transparent'></param><embed src='{$url}' allowfullscreen='true' type='application/x-shockwave-flash' wmode='transparent' width='{$width}' height='{$height}'></embed></object>";
  }

  public function isValidURL($url)
  {
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
  }

  public function isValidImg($img)
  {
    return preg_match('/.(jpg|gif|png)$/i', $img);
  }

  public function checkstr($str)
  {
    $tmpArray = explode(' ', $str);
    $arr = array();
    foreach($tmpArray as $word)
    {
      $word = trim($word);
      if(!$this->isValidURL($word)){
        $arr[] = $word;
      }
      elseif($this->isValidImg($word)){
        $arr[] = "<img itemprop='image' src='{$word}' width='100%' />";
      }
      elseif ($this->isValidURL($word)){
        $arr[] = "<a href='{$word}'>$word</a>";
      }
      $y = new pafap_youtube($word);
      if ($this->isValidURL($word) && $y->parseYoutubeUrl($word)){
        $arr[] = "<a href='http://www.clipconverter.cc/' title='Download this youtube video'><img src='../images/download.png' alt='download' /></a><br />". $y->makeYoutube($word);
      }
    }
    return implode(' ', $arr);
  }

  public function catbinder($cid, $compname)
  {
    $bind = new pafap_bind();
     echo "<li class='category-menu-list-item'>
               <a class='category-menu-list-item-link' href='../categories/ctgrs.php?cid={$bind->sd($cid)}'>
                    <span>$compname</span>
                </a>
          </li>";
  }

  public function showCat($data)
  {
    foreach($data as $key=>$value)
    {
      $this->catbinder($key, $value);
    }
  }

  public function showbinder($data)
  {
    foreach($data as $key=>$value)
    {
      echo "<option rel='".$key."' value='".$key."'>".$value."</option><br>";
    }
  }

  /* print star function */
  public function printStars($stars){
    $viewstar = "";
    for($i=0;$i<$stars;$i++){
      $viewstar .="<img src='../images/sprites/rate-btn3-hover.png' />";
    }
    return $viewstar;
  }

  public function CompanyBinder($catarr, $comparr, $reviewarr){
    $bind = new pafap_bind();
    echo "<div class='col-xs-12 col-sm-6 col-md-4 category-box clearfix'>";
    foreach($catarr as $row){
      $cid = $row["rcid"];
      $cname = $row["cname"];
      $sprite = $row["sprite"];
      //echo "<div class='col-xs-12 col-sm-6 col-md-4 category-box clearfix'>
      echo "<h2 class='h4 category-box-title clearfix'>
               <a href='../categories/ctgrs.php?cid={$bind->sd($cid)}' title='$cname'>
                   <div class='category-box-icon'><img src='../$sprite' /></div>
                   <div class='category-box-name'>$cname</div>
               </a>
           </h2>";
      foreach ($comparr as $rows){
        $comp = $rows["header"];
        $cmpid = $rows["rcompanyid"];
        $crcid = $rows["rcid"];
        if($crcid == $cid){
          $res = $bind->averageByCompId($reviewarr, $cmpid);
          echo "<div class='category-box-company clearfix'>
                    <div class='category-box-company-name'>
                        <a class='category-box-company-name-link' title='$comp' href='../companies/index.php?cmpid={$bind->sd($cmpid)}'>$comp</a>
                    </div>
                    <div class='category-box-company-trustscore'>$res</div>
                </div>";
        }
      }
    }
    "</div>";
  }
  //bind comapany by category id;
  public function CompanyBinderByCid($data, $datareview, $limit){
    $bind = new pafap_bind();
    $rank = 0;
    $index = 0;
    foreach ($data as $row){
      $compname = $row["header"];
      $cmpid = $row["rcompanyid"];
      $rank += 1;
      $index += 1;
      $average = $bind->averageByCompId($datareview, $cmpid);
      $count = $bind->countReviews($datareview, $cmpid);
      //echo $average. " ". $count;
      if ($index <=$limit){
      echo "<div class='rankings'>
                <div id='domain1' class='pageable-item-js ranking clearfix'>
                    <h2>
                        <a href='../companies/index.php?cmpid={$bind->sd($cmpid)}'>
                            $rank. $compname
                        </a>
                    </h2>
                <div class='stats clearfix'>";

                echo "<div itemprop='reviewRating' itemscope='' itemtype='http://schema.org/Rating' class='star-rating count-5 size-medium clearfix'>
                    <div class='star-rating'>
                        <div class='rate-ex1-cnt'>
                            <div id='{$cmpid}{$rank}1' class='rate-btn-{$cmpid}{$rank}1 rate-btn'></div>
                            <div id='{$cmpid}{$rank}2' class='rate-btn-{$cmpid}{$rank}2 rate-btn'></div>
                            <div id='{$cmpid}{$rank}3' class='rate-btn-{$cmpid}{$rank}3 rate-btn'></div>
                            <div id='{$cmpid}{$rank}4' class='rate-btn-{$cmpid}{$rank}4 rate-btn'></div>
                            <div id='{$cmpid}{$rank}5' class='rate-btn-{$cmpid}{$rank}5 rate-btn'></div>
                            <script type='text/javascript'>review('$average', '$cmpid', '$rank');</script>
                        </div>
                    </div>
                </div><br />
                <div class='information'>
                    $count reviews | Scores $average
                </div>
                <div class='review-link'>
                    <a href='../companies/index.php?cmpid={$bind->sd($cmpid)}' title='$compname'>Vlereso Tani</a>
                </div>
                </div>
                </div>
            </div>";
      }
    }
  }
  //users review by company id;
  public function usersReviewByCompanyID($data, $cmpid, $limit){
    $bind = new pafap_bind();
    $index = 0;
    foreach ($data as $row){
      $uid = $row['ruid'];
      $user = $row['fname'];
      $time = $row['date_created'];
      $desc = $row['rnotes'];
      $header = $row['header'];
      $star = $row['stars'];
      $time = strtotime($time);
      $index +=1;
      if($index <= $limit){
        echo "<div class='container'><div class='row'>
        <div itemprop='review' itemscope='' itemtype='http://schema.org/Review' class='review pageable-item-js item clearfix' data-reviewmid='md5($uid)'>
        <meta itemprop='itemreviewed' content='$header'>
        <div itemprop='author' itemscope='' itemtype='http://schema.org/Person' class='user-info clearfix'>
        <div class='user-review-name clearfix'>
            <a class='user-review-name-link' itemprop='url' rel='nofollow' title='go to $user profile' href='/users/index.php?uid={$bind->sd($uid)}'>
                <span itemprop='name'>$user</span>
            </a>
        </div>
        <div class='clearfix'>
            1 Review for $header company
        </div>
        </div>
        <div class='review-info clearfix'>
        Published {$bind->humanTiming($time)} ago
        <meta itemprop='dateCreated' content='{$time}'>
        <h3 itemprop='headline' class='review-title en h4'>
        <a class='review-title-link' rel='nofollow' href='#'>{$this->printStars($star)} Review</a>
        </h3>
        <div itemprop='reviewBody'>
        $desc
        </div>
        </div>
        </div>
        </div></div>";
      }
    }
  }

  //all users reviews at index page;
  public function allUsersReview($data){
    $bind = new pafap_bind();
    foreach ($data as $row){
      $uid = $row['ruid'];
      $user = $row['fname'];
      $time = $row['date_created'];
      $desc = $row['rnotes'];
      $header = $row['header'];
      $star = $row['stars'];
      $img = $row['image'];
      $time = strtotime($time);
      echo "<li class='slide'>
        <div class='quoteContainer'>
          <p class='quote-phrase'><span class='quote-marks'></span>{$desc}</p>
        </div>
        <center><a class='quote-author' href='#'>{$this->printStars($star)} Review for $header Company</a></center>
        <div><img style='border-radius:6px;' src='{$img}' title='{$user}' /></div>
        <div class='authorContainer'>
          <p class='quote-author'><a href='../users/index.php?uid={$bind->sd($uid)}'>{$user}</a></p>
        </div>
      </li>";
    }
  }

  //companies view by user id on reveiws;
  public function companyBinderByUid($data, $limit){
    $bind = new pafap_bind();
    $index = 0;
    foreach ($data as $row){
      $compid = $row['companyid'];
      $header = $row['header'];
      $time = $row['date_created'];
      $desc = $row['rnotes'];
      $star = $row['stars'];
      $time = strtotime($time);
      $index += 1;
      if ($index <= $limit){
        echo "<div class='container'><div class='row'>
        <div itemprop='review' itemscope='' itemtype='http://schema.org/Review' class='review pageable-item-js item clearfix' data-reviewmid='md5($compid)'>
        <meta itemprop='itemreviewed' content='$header'>
        <div itemprop='author' itemscope='' itemtype='http://schema.org/Person' class='user-info clearfix'>
        <div class='user-review-name clearfix'>
            <a class='user-review-name-link' itemprop='url' rel='nofollow' title='go to $header Company' href='/companies/index.php?cmpid={$bind->sd($compid)}'>
                <span itemprop='name'>{$header}'s</span>
            </a>
        </div>
        <div class='clearfix'>
            Client Review
        </div>
        </div>
        <div class='review-info clearfix'>
        Published {$bind->humanTiming($time)} ago
        <meta itemprop='dateCreated' content='{$time}'>
        <h3 itemprop='headline' class='review-title en h4'>
        <a class='review-title-link' rel='nofollow' href='#'>{$this->printStars($star)} Company Review</a>
        </h3>
        <div itemprop='reviewBody'>
        $desc
        </div>
        </div>
        </div>
        </div></div>";
      }
    }
  }

  // left side about company and vlereso;
  public function leftSideInfo(){
    echo "<div style='background-color: #E5E4E2;' data-ng-controller='CompanyInformationController' class='col-xs-12 col-sm-12 col-md-4 column-2 ng-scope'>


    <div style='display: block;' class='company-box b2b-cta-container'>
    <h3 class='min-margin'>Are you a business owner?</h3>
    <span>Get your <a class='free-business-account-cta-js' rel='nofollow' href='http://vlereso.com/companies/signup.php?status=true'>free account now</a>.</span>
    <span class='close-b2b-cta-container-js'></span>
    </div>




    <div id='support-box-companyinfo' class='company-box company-info'>

    <div class='company-info-wrapper'>

        <span class='ng-scope' data-ng-if='true &amp;&amp; isReady'>
            <img src='../<?php echo $cimg; ?>' data-ng-if='true' data-ng-src='#' data-ng-alt='' class='company-aside-logo ng-scope'>

            <div data-ng-repeat-start='sellingPoint in profilePromotion.sellingPoints' class='sp-box ng-scope'>
                <p class='ng-binding' data-ng-bind='sellingPoint.text'><?php echo $desc; ?></p>
            </div>
        </span>

        <p></p>

        <div class='contact clearfix'>
                    <h3>Contact information</h3>
                    <div>
                        <span class='first'>
                            Write to:
                        </span>
                        <span class='last'>
                            <a href='mailto:<?php echo $cemail; ?>'><span itemprop='email'><?php echo $cemail; ?></span></a>
                        </span>
                    </div>
                    <div>
                        <span class='first'>
                            Call us on:
                        </span>
                        <span itemprop='telephone' class='last'>
                            <?php echo $phone; ?>
                        </span>
                    </div>
                    <div>
                        <span class='first'>
                            We live here:
                        </span>
                        <span itemprop='address' itemscope='' itemtype='http://schema.org/PostalAddress' class='last'>
                                <span itemprop='streetAddress'><?php echo $addr; ?></span><br>
                        <span itemprop='addressCountry'><?php echo $location; ?></span><br>
                        </span>
                    </div>
        </div>

    <p><b><?php echo $compname; ?></b> is  ranked <b><?php echo $average; ?></b> in the Vlereso.com</p>

    </div>
    </div>




    <div data-ng-show='false &amp;&amp; isReady' class='company-box warranty-box ng-hide'></div>


    <div class='company-box teaser-reviewhandling'>
    <h2>Vlereso Commitment</h2>
    <p class='top-section'>
        Vlereso is committed to ensuring better online shopping experiences for everyone, which means we work hard to fight fabricated reviews. No company can delete or otherwise censor reviews. <a rel='nofollow' href='#'>Find out more.</a>
        <br><br>
      <a href='#'>Let Vlereso know</a> if you notice reviews you believe are fabricated.
    </p>

    <div class='divider'></div>
    </div>

    </div>";
  }

}

?>