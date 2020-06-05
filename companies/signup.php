<!DOCTYPE html>
<html lang="en-US">
<head>

<META NAME="Description" CONTENT="Vlereso - Experience the power of customer reviews">
<META http-equiv="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<title>Vlereso - Companies Registration Form</title>
<META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW">
<link rel="icon" href="images/favicon.ico">

<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="theme-color" content="#292929">
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" sizes="196x196" href="#">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="Vlereso">

<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../css/minsources.css" type="text/css" />
<link rel="stylesheet" href="../css/pafap_global.css" type="text/css" />
<link rel="stylesheet" href="../css/social-buttons.css" type="text/css" />

<link rel="stylesheet" href="../css/styles.css" type="text/css" />
<script src="../scripts/jquery-latest.min.js" type="text/javascript"></script>
<script src="../scripts/script.js"></script>

<script>
$(document).ready (function(){
    $('#company-signup-form').submit ( function() {
        $('#signupresult').html('<center><img src="../images/loading.gif" alt="Sending"/></center>');
		$.post('company-signup.php', $('#company-signup-form').serialize(), function(data) {
          $("#compsignupresult").html(data).hide().fadeIn(2000).fadeOut(10000, function(){});
		});
		return false;
	});
});
</script>

</head>
<body>
<div id="wrapper" class="wrapper">
<!-- start of header -->
<div class="ng-scope" style="background: #292929;">
<div class="navbar navbar-default navbar-fixed-top navbar-inverse closed" style="margin-top:0px;">
    <div class="container header-navbar-wrapper closed">
        <a href="/" />
            <img class="vlereso-logo" width="120" height="25" title="Vlereso" src="../images/vlereso-logo.png"/>
        </a>
        <div id="cssmenu">
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../companies/login.php?status=true">Login</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- end of header -->


<main class="container not-navigation" style="margin-top: 70px;">
  <div class="row">

    <article class="col-md-7">
      <h1>Ready to collect reviews?</h1>
      <p class="lead">Start collecting reviews today to learn how you can build <strong>strong relationships</strong> and <strong>improve your company&#39;s online reputation</strong> through customer reviews</p>
      <div class="media media-getstarted">
        <div class="media-left getstarted-engagewithcustomers"></div>
        <div class="media-body"><br />
          <p><strong>Sign up on www.vlereso.com</strong> by filling all the fields in the form</p>
          <p>or you can login <strong><a href="../companies/login.php?status=true">here</a></strong></p>
        </div>
      </div>

    </article>

    <aside class="col-md-5" style="background-color: #a0a0a0;">

      <form id="company-signup-form" class="form-inverse" method="post" action="#" data-event-name="SignUp" novalidate="">
        <input name="_csrf" value="" type="hidden">
        <input name="consent" value="true" type="hidden">

        <fieldset>
          <legend>
              Complete the form to get your Free Vlereso Account
          </legend>

          <div id="signup-errors" class="alert alert-danger text-danger hide">
            You also have the option to <span role="button" class="app-request-callback btn-text">request a callback</span> and we will get you set up.
          </div>

          <div id="callback-success" class="alert alert-success hide">
            Thank you for requesting a callback. We’ll be in touch as soon as we can. In the meantime, why not <a href="#">check out our blog?</a>
          </div>

          <div class="form-group has-error" id="name-error">
            <label for="name" class="placeholder">Full name</label>
            <input id="fname" name="fname" placeholder="Full name" class="form-control input-lg" required="" autofocus="" type="text">
            <label class="control-label" id="name-error-message">Please enter your full name</label>
          </div>

          <div class="form-group" id="website-error">
            <label for="Website" class="placeholder">Website</label>
            <input id="website" name="website" placeholder="Website" class="form-control input-lg" required="" pattern="(http(s)?:\/\/)?([a-zA-Z0-9-_]+\.)+[a-zA-Z]{2,5}(\.[a-zA-Z]{2,5})?(\/)?" type="text">
            <label class="control-label hide" id="website-error-message">Please enter your website</label>
          </div>

          <div class="form-group" id="email-error">
            <label for="email-address" class="placeholder">Email address</label>
            <input id="emailAddress" name="emailAddress" placeholder="Email address" class="form-control input-lg" required="" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$" type="email">
            <label class="control-label hide" id="email-error-message">This e-mail address is not valid</label>
          </div>

          <div class="form-group" id="telephone-error">
            <label for="telephone" class="placeholder">Telephone</label>
            <input id="telephone" name="telephone" placeholder="Telephone" class="form-control input-lg" required="" type="tel">
            <label class="control-label hide" id="telephone-error-message">Please enter your phone number</label>
          </div>

          <div class="form-group" id="company-error">
            <label for="company-name" class="placeholder">Company name</label>
            <input id="companyName" name="companyName" placeholder="Company name" class="form-control input-lg" required="" type="text">
            <label class="control-label hide" id="company-error-message">Please enter your company name</label>
          </div>

          <div class="form-group">
            <label for="locale" class="placeholder">Country</label>
            <select id="locale" name="locale" class="form-control input-lg">
                <option value="ps-AF" data-english-name="Afghanistan">Afghanistan</option>
                <option value="sq-AL" selected="selected" data-english-name="Albania">Albania</option>
                <option value="ar-DZ" data-english-name="Algeria">Algeria</option>
                <option value="CA-ES" data-english-name="Andorra">Andorra</option>
                <option value="es-AR" data-english-name="Argentina">Argentina</option>
                <option value="hy-AM" data-english-name="Armenia">Armenia</option>
                <option value="en-AU" data-english-name="Australia">Australia</option>
                <option value="de-AT" data-english-name="Austria">Austria</option>
                <option value="az-AZ" data-english-name="Azerbaijan">Azerbaijan</option>
                <option value="ar-BH" data-english-name="Bahrain">Bahrain</option>
                <option value="bn-BD" data-english-name="Bangladesh">Bangladesh</option>
                <option value="be-BY" data-english-name="Belarus">Belarus</option>
                <option value="fr-BE" data-english-name="Belgium">Belgium</option>
                <option value="en-BZ" data-english-name="Belize">Belize</option>
                <option value="es-BO" data-english-name="Bolivia">Bolivia</option>
                <option value="hr-BA" data-english-name="Bosnia And Herzegovina">Bosnia And Herzegovina</option>
                <option value="pt-BR" data-english-name="Brazil">Brazil</option>
                <option value="ms-BN" data-english-name="Brunei">Brunei</option>
                <option value="bg-BG" data-english-name="Bulgaria">Bulgaria</option>
                <option value="km-KH" data-english-name="Cambodia">Cambodia</option>
                <option value="en-CA" data-english-name="Canada">Canada</option>
                <option value="es-CL" data-english-name="Chile">Chile</option>
                <option value="zh-CN" data-english-name="China">China</option>
                <option value="es-CO" data-english-name="Colombia">Colombia</option>
                <option value="es-CR" data-english-name="Costa Rica">Costa Rica</option>
                <option value="hr-HR" data-english-name="Croatia">Croatia</option>
                <option value="el-CY" data-english-name="Cyprus">Cyprus</option>
                <option value="cs-CZ" data-english-name="Czech Republic">Czech Republic</option>
                <option value="da-DK" data-english-name="Denmark">Denmark</option>
                <option value="es-DO" data-english-name="Dominican Republic">Dominican Republic</option>
                <option value="es-EC" data-english-name="Ecuador">Ecuador</option>
                <option value="ar-EG" data-english-name="Egypt">Egypt</option>
                <option value="es-SV" data-english-name="El Salvador">El Salvador</option>
                <option value="et-EE" data-english-name="Estonia">Estonia</option>
                <option value="am-ET" data-english-name="Ethiopia">Ethiopia</option>
                <option value="fo-FO" data-english-name="Faroe Islands">Faroe Islands</option>
                <option value="fi-FI" data-english-name="Finland">Finland</option>
                <option value="fr-FR" data-english-name="France">France</option>
                <option value="ka-GE" data-english-name="Georgia">Georgia</option>
                <option value="de-DE" data-english-name="Germany">Germany</option>
                <option value="en-GI" data-english-name="Gibraltar">Gibraltar</option>
                <option value="el-GR" data-english-name="Greece">Greece</option>
                <option value="kl-GL" data-english-name="Greenland">Greenland</option>
                <option value="es-GT" data-english-name="Guatemala">Guatemala</option>
                <option value="es-HN" data-english-name="Honduras">Honduras</option>
                <option value="zh-HK" data-english-name="Hong Kong">Hong Kong</option>
                <option value="hu-HU" data-english-name="Hungary">Hungary</option>
                <option value="is-IS" data-english-name="Iceland">Iceland</option>
                <option value="hi-IN" data-english-name="India">India</option>
                <option value="id-ID" data-english-name="Indonesia">Indonesia</option>
                <option value="fa-IR" data-english-name="Iran">Iran</option>
                <option value="ar-IQ" data-english-name="Iraq">Iraq</option>
                <option value="en-IE" data-english-name="Ireland">Ireland</option>
                <option value="he-IL" data-english-name="Israel">Israel</option>
                <option value="it-IT" data-english-name="Italy">Italy</option>
                <option value="en-JM" data-english-name="Jamaica">Jamaica</option>
                <option value="ja-JP" data-english-name="Japan">Japan</option>
                <option value="ar-JO" data-english-name="Jordan">Jordan</option>
                <option value="kk-KZ" data-english-name="Kazakhstan">Kazakhstan</option>
                <option value="sw-KE" data-english-name="Kenya">Kenya</option>
                <option value="ko-KR" data-english-name="Korea">Korea</option>
                <option value="ar-KW" data-english-name="Kuwait">Kuwait</option>
                <option value="ky-KG" data-english-name="Kyrgyzstan">Kyrgyzstan</option>
                <option value="lo-LA" data-english-name="Lao P.D.R.">Lao P.D.R.</option>
                <option value="lv-LV" data-english-name="Latvia">Latvia</option>
                <option value="ar-LB" data-english-name="Lebanon">Lebanon</option>
                <option value="ar-LY" data-english-name="Libya">Libya</option>
                <option value="de-LI" data-english-name="Liechtenstein">Liechtenstein</option>
                <option value="lt-LT" data-english-name="Lithuania">Lithuania</option>
                <option value="lb-LU" data-english-name="Luxembourg">Luxembourg</option>
                <option value="zh-MO" data-english-name="Macao S.A.R.">Macao S.A.R.</option>
                <option value="mk-MK" data-english-name="Macedonia (FYROM)">Macedonia (FYROM)</option>
                <option value="ms-MY" data-english-name="Malaysia">Malaysia</option>
                <option value="dv-MV" data-english-name="Maldives">Maldives</option>
                <option value="mt-MT" data-english-name="Malta">Malta</option>
                <option value="en-MU" data-english-name="Mauritius">Mauritius</option>
                <option value="es-MX" data-english-name="Mexico">Mexico</option>
                <option value="mn-MN" data-english-name="Mongolia">Mongolia</option>
                <option value="ar-MA" data-english-name="Morocco">Morocco</option>
                <option value="ne-NP" data-english-name="Nepal">Nepal</option>
                <option value="nl-NL" data-english-name="Netherlands">Netherlands</option>
                <option value="en-NZ" data-english-name="New Zealand">New Zealand</option>
                <option value="es-NI" data-english-name="Nicaragua">Nicaragua</option>
                <option value="yo-NG" data-english-name="Nigeria">Nigeria</option>
                <option value="nb-NO" data-english-name="Norway">Norway</option>
                <option value="ar-OM" data-english-name="Oman">Oman</option>
                <option value="ur-PK" data-english-name="Pakistan">Pakistan</option>
                <option value="ur-PK" data-english-name="Pakistan">Pakistan</option>
                <option value="ar-PS" data-english-name="Palestine">Palestine</option>
                <option value="es-PA" data-english-name="Panama">Panama</option>
                <option value="es-PY" data-english-name="Paraguay">Paraguay</option>
                <option value="es-PE" data-english-name="Peru">Peru</option>
                <option value="en-PH" data-english-name="Philippines">Philippines</option>
                <option value="pl-PL" data-english-name="Poland">Poland</option>
                <option value="pt-PT" data-english-name="Portugal">Portugal</option>
                <option value="fr-MC" data-english-name="Principality of Monaco">Principality of Monaco</option>
                <option value="es-PR" data-english-name="Puerto Rico">Puerto Rico</option>
                <option value="ar-QA" data-english-name="Qatar">Qatar</option>
                <option value="en-CD" data-english-name="Republic of Congo">Republic of Congo</option>
                <option value="ro-RO" data-english-name="Romania">Romania</option>
                <option value="ru-RU" data-english-name="Russia">Russia</option>
                <option value="rw-RW" data-english-name="Rwanda">Rwanda</option>
                <option value="ar-SA" data-english-name="Saudi Arabia">Saudi Arabia</option>
                <option value="wo-SN" data-english-name="Senegal">Senegal</option>
                <option value="sr-RS" data-english-name="Serbia">Serbia</option>
                <option value="zh-SG" data-english-name="Singapore">Singapore</option>
                <option value="sk-SK" data-english-name="Slovakia">Slovakia</option>
                <option value="sl-SI" data-english-name="Slovenia">Slovenia</option>
                <option value="en-ZA" data-english-name="South Africa">South Africa</option>
                <option value="es-ES" data-english-name="Spain">Spain</option>
                <option value="si-LK" data-english-name="Sri Lanka">Sri Lanka</option>
                <option value="sv-SE" data-english-name="Sweden">Sweden</option>
                <option value="de-CH" data-english-name="Switzerland">Switzerland</option>
                <option value="ar-SY" data-english-name="Syria">Syria</option>
                <option value="zh-TW" data-english-name="Taiwan">Taiwan</option>
                <option value="th-TH" data-english-name="Thailand">Thailand</option>
                <option value="en-TT" data-english-name="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="ar-TN" data-english-name="Tunisia">Tunisia</option>
                <option value="tr-TR" data-english-name="Turkey">Turkey</option>
                <option value="tk-TM" data-english-name="Turkmenistan">Turkmenistan</option>
                <option value="ar-AE" data-english-name="U.A.E.">U.A.E.</option>
                <option value="uk-UA" data-english-name="Ukraine">Ukraine</option>
                <option value="en-GB" data-english-name="United Kingdom">United Kingdom</option>
                <option value="en-US" data-english-name="United States">United States</option>
                <option value="es-UY" data-english-name="Uruguay">Uruguay</option>
                <option value="es-VE" data-english-name="Venezuela">Venezuela</option>
                <option value="vi-VN" data-english-name="Vietnam">Vietnam</option>
                <option value="ar-YE" data-english-name="Yemen">Yemen</option>
                <option value="en-ZW" data-english-name="Zimbabwe">Zimbabwe</option>
            </select>
          </div>

          <div class="form-group">
              <button type="submit" id="signup-submit" class="btn btn-primary btn-lg btn-block">Start collecting reviews</button>
          </div>

          <div class="form-group">
              <p class="small">
                      By clicking above you accept our <a href="#">Privacy policy</a>
              </p>
          </div>
        </fieldset>
        <div id="compsignupresult"></div>
      </form>
    </aside>

  </div>
</main>

</div>
<div class="col-sm-4 col-md-4 footer-list-container">
    <div class="col-sm-8 col-md-8 footer-copyright-text">&copy;2016 Vlereso, Inc.</div>
</div>
</body>
</html>

