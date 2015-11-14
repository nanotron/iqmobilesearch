<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?  
  /*
    Author: Ernest Millan
  */

  // General Strings  
  $domainName="iqmobilesearch.com";
  $cookieName="ifonify.com";  
  $hostName="iqmobilesearch.com";
  $hostTest = substr_count($_SERVER['HTTP_HOST'],$domainName);
  if($hostTest != 0) {
    $cookieName=$hostName=$domainName;
  }    
  $location = (isset($_COOKIE["location"])) ? $_COOKIE["location"] : "";
  $default_buttons_cookie = "g,gimg,imgur,reddit,duckduckgo,bing,yelp,wi,twitter,youtube,dict,ama,eb,f,y,imdb";
  $cookie_expire = time() + 60 * 60 * 24 * 360;
    
  if (!isset($_COOKIE["country"])) {
    setcookie("country", "us", $cookie_expire, "/", $cookieName);    //setcookie(name,value,expire,path,domain,secure)
  }  
  if (!isset($_COOKIE["buttons"])) {
    setcookie("buttons", $default_buttons_cookie, $cookie_expire, "/", $cookieName);
  } 
  if (!isset($_COOKIE["def_buttons"])) {
    setcookie("def_buttons", $default_buttons_cookie, $cookie_expire, "/", $cookieName);
  }
  if (isset($_COOKIE["iQ"])) {
    setcookie("iQ", "", time(), "/", $cookieName);
  }

	/* New Button Force Cookie Add */  
	function forceCookiePromo($cName){
    if($_COOKIE["button_promo_".$cName] != "1") {
			setcookie("buttons", $cName.",".$_COOKIE["buttons"], $cookie_expire, "/", $cookieName);
			setcookie("button_promo_".$cName, "1", $cookie_expire, "/", $cookieName);
		}
  }
	if(isset($_COOKIE["buttons"])) {
		forceCookiePromo("imgur");
		forceCookiePromo("reddit");
		forceCookiePromo("duckduckgo");
	}
	
  
  // United States (Default)
  $pageTitle="iQ";
  $pageTitleB="Mobile Search";
  $desc="Use iQ Mobile Search with your iPhone, Android or smartphone device, to search popular services such as Google, Bing, Yelp, Twitter, Amazon, eBay, Wikipedia, and more.";
  $keywords="";
  
  // Build 'Popular Searches'
  $gtrends_url = "http://www.google.com/trends/hottrends/atom/hourly";
  $request = file_get_contents($gtrends_url);

  if($request) {
    $keywords = (string)$request;
    $keywords = str_replace('</a></span></li>',',',$keywords);
    $keywords = str_replace('Google Hot Trends',null,$keywords);
    $keywords = str_replace('What are people searching for on Google today?',null,$keywords);
    $keywords = str_replace('<![CDATA[',null,$keywords);
    $keywords = str_replace(']]>',null,$keywords);
    $keywords = preg_replace('@<title[^>]*?>.*?<\/title>@si', '', $keywords);
    $keywords = str_replace($gtrends_url, null, $keywords);
    $keywords = preg_replace('/(\d{4})-(\d{2})-(\w{5}:\d{2}:\w{3})/', null, $keywords);
    $keywords = preg_replace('/(\d{4})-(\d{2})/', null, $keywords);
    $keywords = trim(preg_replace('/\s+/', ' ', $keywords));
    $keywords = strip_tags($keywords);
    $keywords = trim($keywords);
    $keywords = preg_replace('/^,/', null, $keywords);
    $keywords = preg_replace('/,$/', null, $keywords);
    $keywords = trim($keywords);
    $keywords = explode(",",$keywords);
    $keyword_links = array();
  
    for ($i=0;$i<=10;$i++) {
      $keyword_link = trim($keywords[$i]);
      $keyword_link = "<a href=\"#\" onclick=\"javascript:iQ.populatePop('".addslashes($keyword_link)."');return false;\">".$keyword_link."</a>";
      array_push($keyword_links,$keyword_link);
    }
    $keyword_texts = array();
    for ($i=0;$i<=10;$i++) {
      $keyword_txt = trim($keywords[$i]);
      array_push($keyword_texts,$keyword_txt);
    }
    $keyword_links = implode(", ",$keyword_links);
    $keyword_texts = implode(", ",$keyword_texts);
  }

  $promo="<span class=\"new\">New!</span> Imgur, Reddit & DuckDuckGo added. Enjoy!";
  
  $copyright="&copy;&nbsp;2014";
  $me="Ernest Millan";
  $edit="Edit";
  $done="Done";
  $donate="Donate";
  $feedback="Feedback";
  $restore="Restore Default Buttons";
  $pleaseType="Please type in a search term.";
  $australia="Australia";
  $canada="Canada";
  $france="France";
  $germany="Germany";
  $japan="Japan";
  $italy="Italy";
  $mexico="Mexico";
  $netherlands="Netherlands";
  $unitedKingdom="United Kingdom";
  $unitedStates="United States";
  $russia="Russia";
  $spain="Spain";
  $southkorea="South Korea";
  $switzerland="Switzerland";
  $myCountry=$unitedStates;
  $myCountryCode="us";
  $yourCountry="";
  
  $google="Google";
  $googleB="";
  //$googleAct="www.google.com/cse?cx=partner-pub-0446740701433346%3Abfdfr0gehb4&ie=ISO-8859-1&q=\"+iQt+\"&sa=Search";
  $googleAct="www.google.com";
  $googleActPaPub="partner-pub-0446740701433346:3seqpeuxdse";
  $dictionary="Dictionary.com";
  $dictionaryAct="m.reference.com/d/search.html?q=\"+iQt+\"";
  $googleImgs=$google." Images";
  $googleImgsAct="www.google.com";
  $amazon="Amazon.com";
  $amazonAct="www.amazon.com";
  $amazonActB="/gp/aw/s.html?k=\"+iQt+\"&m=aps&tag=iqmobsea-20&creative=374005&campaign=211041&adid=1WTTMBDH444VTV7JXKE1";
  $ask="Ask.com";
  $askAct="m.ask.com";
  $askActB="/wap4?sid=10-0-90-202-ask-1221083021432&app=ask&crt=MAIN&trc=&QUERY=\"+iQt+\"&submit-WEBSEARCH-BUTTONIMAGE1=Search";
  $askActInt="/web?q=\"+iQt+\"";
  $bing="Bing";
  $bingAct="m.bing.com";
  $bingActB="?q=\"+iQt+\"&d=ALLLOC&dl=&a=results&MID=1";
  $ebay="eBay";
  $ebayAct="www.mobileweb.ebay.com";
  $ebayActB="/searchresults?cmd=SKW&kw=\"+iQt+\"&x=0&y=0";
  $ebayActInt="/?_nkw=\"+iQt+\"";
  $flickr="Flickr";
  $flickrAct="m.flickr.com/#/search/advanced_QM_q_IS_\"+iQt+\"_AND_ss_IS_2_AND_prefs_photos_IS_1_AND_mt_IS_all_AND_w_IS_all";    
  $imdb="IMDb";
  $imdbAct="m.imdb.com";
  $cnet="CNET";
  $cnetAct="m.cnet.com";
  $cnetActB="/4344-5_9-0.html?query=\"+iQt+\"&Search=Go";
  $cnetActInt="/search/?query=\"+iQt+\"";
  $twitter="Twitter";
  $twitterAct="mobile.twitter.com";
  $twitterActB="/searches?q=\"+iQt+\"";
  $yahoo="Yahoo!";
  $yahooB="";
  $yahooAct="us.m.yahoo.com";
  $yahooActB="/p/search;_ylt=A0S02JJOW8BIldoAmgBaLy4J?p=\"+iQt+\"&submit=oneSearch";
  $yelp="Yelp";
  $yelpAct="mobile.yelp.com";
  $yelpActB="/search?find_desc=\"+iQt+\"&find_loc=";
  $wikipedia="Wikipedia";
  $wikipediaAct="en.mobile.wikipedia.org";
  $wikipediaActB="/transcode.php?go=\"+iQt+\"";
  $wikipediaActInt="/wiki/\"+iQt+\"";
  $wikitravel="WikiTravel";
  $wikitravelAct="m.wikitravel.org/en/?search=\"+iQt+\"";
  $popSearches="Popular Searches";
  $youtube="YouTube";
  $youtubeAct="m.youtube.com/#/results?q=\"+iQt+\"";
  $imgur="Imgur";
  $imgurAct="m.imgur.com/search/\"+iQt+\"?mobile=1";
  $reddit="Reddit";
  $redditAct="www.reddit.com/search.compact?q=\"+iQt+\"&sort=relevance&t=all";
  $duckduckgo="DuckDuckGo";
  $duckduckgoAct="www.duckduckgo.com?q=\"+iQt+\"";
  
  include "i18n.php";
  
  $appName=$pageTitle." ".$pageTitleB;
?>
<?
  function callback($buffer) {
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer); // remove comments
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer); // remove tabs, spaces, newlines, etc.
    $buffer = str_replace('{ ', '{', $buffer); // remove unnecessary spaces.
    $buffer = str_replace(' }', '}', $buffer);
    //$buffer = str_replace('; ', ';', $buffer);
    //$buffer = str_replace(', ', ',', $buffer);
    $buffer = str_replace(' {', '{', $buffer);
    $buffer = str_replace('} ', '}', $buffer);
    $buffer = str_replace(': ', ':', $buffer);
    $buffer = str_replace(' ,', ',', $buffer);
    $buffer = str_replace(' ;', ';', $buffer);
    return $buffer;
  }
  ob_start("callback");
?>
<!DOCTYPE html>
<html>
<head>
  <title><?=$appName;?> for iPhone, iPad, Android and mobile devices</title>
  <meta charset="utf-8" />  
  <meta name="description" content="<?=$desc;?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-title" content="iQ Search" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="apple-touch-fullscreen" content="yes" />
  <meta name="apple-mobile-web-app-capable" content="no" />
  <meta name="HandheldFriendly" content="true" />
  <meta name="MobileOptimized" content="width" />   
  <link rel="apple-touch-icon" href="apple-touch-icon.png"/>  
  <style type="text/css">
    body{font-family:Arial, Helvetica, sans-serif;background:#fff;font-weight:bold;text-align:center;font-size:1em;margin:0;}
    a, a:visited{color:#00f;}
    /*#adbanner{border-bottom:1px solid #333;background:-moz-linear-gradient(top, #fff, #ddd);background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#fcfcfc), color-stop(0.5, #eee), color-stop(0.5, #e3e3e3), to(#eee));}*/
    #adbanner{height:50px;}
    #adbanner a img{display:block;margin:0 auto;}
    #promo{display:block;}
    #promo,#promo a{font-weight:normal;font-size:0.9em;padding:2px 0 10px 0;font-weight:bold;color:#999;}
    #trends{padding-top:3px;}  
    .new{color:#0a0;}
    #title{position:relative;text-align:center;color:#eee;height:45px;
      background:#444;
      background-image:linear-gradient(#666, #555);
    }
      #title h1{position:relative;top:13px;font-size:1.0em;font-weight:normal;padding:0;margin:0;}
      #edit{width:2rem;border:1px solid #777;visibility:hidden;position:absolute;font-size:13px;font-weight:bold;top:6px;right:6px;display:inline-block;padding:7px 12px;border-radius:0.25em;}
      .edit_off{color:#ccc;}
      .edit_on{/*background:#ccc;color:#007aff;*/background:#777;color:#eee;}
    
    #query{
      background:#444;
      background-image:linear-gradient(#555, #666);
      padding:0 5px 7.5px 5px;
    }

    #iq_input{color:#eee;border:0;border-radius:0.25em;background:#777;font-size:1.3em;display:inline-block;width:282px;-webkit-appearance:none;}
    #iq_input::-webkit-input-placeholder{color:#ccc;}
    
    #iq_input_suggest{display:none;overflow:hidden;position:absolute;z-index:9999;margin:-2px 0 0 12px;
    								  background:#555;color:#fff;width:290px;height:110px;box-shadow:1px 1px 2px rgba(0,0,0,0.1);border-radius:0 0 0.25em 0.25em;text-align:left;}
      #iq_input_suggest .loader{margin:4px;}
    #iq_input_suggest_list > li{list-style-type:none;padding:4px;display:block;overflow:hidden;}
      #iq_input_suggest_list > li:hover{background:rgba(0,0,0,0.1);}
        
    #sections{position:relative;padding:10px 0 10px 0;}
    #sections.sections_edit_off{background:#fff;}
    #sections.sections_edit_on{padding:5px 0 0 0 !important;background-color:#fff;text-align:left;}
      #buttons{position:relative;}
      .sec,#restore .button{position:relative;width:260px;height:44px;color:black;margin:0 auto 5px auto;}
      .sec h2,.sec .pa{position:absolute;top:12px;left:36px;text-shadow:rgba(255,255,255,0.1) 1px 1px 1px;padding:0;margin:0;font-size:1.05em;font-weight:normal;}
      .sprite,.spr{background:url("./i/sprite.png") no-repeat top left;}
      .spr{width:16px;height:16px;position:absolute;top:14px;left:15px;}
      .sec img{position:relative;top:2px;}
      .sec:hover,#edit,#restore{cursor:pointer;}
      .sec .soft{color:#999;font-weight:normal;}
      .sec a{width:234px;height:36px;display:block;color:black;text-decoration:none;}
    .q_field{color:#111;}
    form, input{display:inline;}
    input[type="text"]{font-size:16px;width:214px;border:1px solid #bbb;}
    .edit_title{color:#838383;font-weight:normal;padding:3px;text-shadow:1px 1px 1px rgba(255,255,255,0.3);}
    #services_txt{display:none;padding-top:5px;padding:10px;}
    #flag{position:relative;top:2px;}
    #location,#country{display:none;padding:10px;}
    #location input{width:70%;background:#e3e3e3;border:0;-webkit-appearance:none;}
	    #location input::-webkit-input-placeholder{color:#777;}
    #location{padding-top:0;border-bottom:1px solid #eee;}
    #country{padding-bottom:10px;}
      #country select{font-size:0.8em;border-color:#bbb;}
    #info{font-family:times;position:absolute;left:10px;top:11px;width:20px;padding:2px 1px 0px 1px;height:20px;background:#000;color:white;font-weight:bold;font-style:italic;border-radius:12px;}
    #popular{color:#333;font-size:1em;padding:10px 30px;margin:0;text-align:left;background:#eee;font-weight:normal;}
      #popular a{line-height:1.5rem;}  
    #footer{background:#fff;font-size:0.8em;font-weight:normal;color:#bbb;padding:10px;}    
      #footer a{color:#bbb;}  
    #restore{display:none;margin-top:20px;background:#f3f3f3;padding:20px;text-align:center;}
      #restore .pa{color:#fff;padding-top:8px;}  
      
    .spr-button{border:1px solid #ccc;background-color:#eee;background:-moz-linear-gradient(top, #eee, #eee);background:linear-gradient(#fff, #eee) /*-webkit-gradient(linear, 0% 0%, 0% 100%, from(#eee), color-stop(0.5, #eee), color-stop(0.5, #eee), to(#eee))*/;border-radius:0.25em;-webkit-box-shadow:1px 1px 2px #e3e3e3;}      
    .spr-button_restore{background-color:#dca09f;background:-moz-linear-gradient(top, #b12c29, #b12c29);background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#b12c29), color-stop(0.5, #b12c29), color-stop(0.5, #b12c29), to(#b12c29));position:relative;margin:0 auto;padding:0 0 7px 0;width:234px;border-radius:0.25em;-webkit-box-shadow:#eee 1px 1px 1px;}
    .spr-del,.spr-del-show{display:none;text-shadow:rgba(50,50,50,0.1) -1px -1px -1px;border-radius:12px;background-color:#c00;background:-moz-linear-gradient(top, #c00, #c00);background:-webkit-gradient(linear, left top, left bottom, from(#c00), to(#c00));-webkit-box-shadow:2px 2px 2px #bbb;border:0;color:white;font-weight:bold;font-size:24px;padding:0 0 10px 6px;width:20px;position:absolute;top:8px;left:-34px;}
    /*.spr-mag{background-position:1px -286px;margin:0 auto;position:relative;z-index:10;left:-138px;top:5px;width:35px;height:32px;visibility:hidden;}*/
    .spr-dict{background-position: 0 -1px;} 
    .spr-y{background-position:0 -28px;} 
    .spr-del-show{display:block;} 
    .spr-mw{background-position:0 -238px;} 
    .spr-bing{background-position:0 -53px;} 
    .spr-lin{background-position:0 -79px;} 
    .spr-wi,.spr-wikitravel{background-position:0 -107px;} 
    .spr-yans{background-position:0 -440px;} 
    .spr-g,.spr-gimg{background-position:0 -138px;} 
    .spr-button_edit{background-position:0 -532px;} 
    .spr-exp{background-position:0 -592px;} 
    .spr-eb{background-position:0 -164px;} 
    .spr-imdb{background-position:0 -186px;} 
    .spr-ask{background-position:0 -211px;} 
    .spr-button_done{background-position:0 -776px;} 
    .spr-ama{background-position:0 -260px;} 
    .spr-twitter{background-position:0 -348px;} 
    .spr-f{background-position:0 -235px;} 
    .spr-mw{background-position:0 0px;}
    .spr-yelp{background-position: 0 -326px;}
    .spr-youtube{background-position: -1px -372px;}
    .spr-imgur{background-position: -1px -398px;}
    .spr-reddit{background-position: -1px -419px;}
    .spr-duckduckgo{background-position: -1px -442px;}
    
    .promo img{padding:1px;border:1px solid #e3e3e3;margin-top:12px;}
    .gray{color:#ccc;}
    .gray-dk{color:#aaa;}
    .small{font-size:.7em;} 
    .right{text-align:right;} 
    .center{text-align:center;} 
    #iq_input_container{position:relative;}
    .search_form_clear{display:none;padding:5px;position:absolute;top:3px;right:15px;}
    .reorder,.reorder_show{position:absolute;right:2px;top:2px;font-size:2.1em;color:#b9b9b9;text-shadow:rgba(255,255,255,0.3) 1px 1px 1px;display:none;} 
    .reorder_show{display:block;}   
    /*.loader{background:url("http://millan.info/img/loader2_sm.gif") no-repeat;width:20px;height:20px;}*/
    .loader{font-size:1em;font-weight:normal;}
    .g_plus{margin-bottom:1em;text-align:center;}
    <!--?if(stristr($_SERVER['HTTP_USER_AGENT'], 'iPhone')) {echo '#mag{visibility:visible;}';}?-->
  </style>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-1989347-5', 'auto');
    ga('send', 'pageview');
  </script>
</head>
<body>
  <!--?=$existing_cookie_plus_new_appended?-->
  <div id="title"><h1><?=$appName;?></h1><div id="edit" class="edit_off"><?=$edit;?></div></div>
  <div id="query">
    <!--div class="sprite spr-mag" id="mag"></div-->
    <div id="iq_input_container">
      <input id="iq_input" type="text" value="" placeholder="Enter a Search Term" autocorrect="off" autocomplete="off" autocapitalize="off" class="q_field" />
      <div id="iq_input_suggest"><div id="iq_input_suggest_list"><div class="loader">Loading...</div></div></div>
    </div>
  </div>    
  <div id="sections" class="sections_edit_off">      
      <!--div id="promo"><?= $promo; ?></div-->
      <div id="country"><div class="edit_title">Your Country</div><select id="country_select"><?=$countryOpts;?></select> <!--img src="./i/flags/<?=$myCountryCode;?>.gif" id="flag" /--></div>
    <? if(isset($_COOKIE["country"]) && ($_COOKIE["country"] == "us" || $_COOKIE["country"] == "")) { ?>
      <div id="location"><div class="edit_title">Your Zip/City</div><div><input id="location_input" placeholder="Your Zip or City & State" type="text" name="zipcode" maxlength="300" value="<?= $location; ?>" /></div></div>
    <? } ?>
    <div id="services_txt"><div class="edit_title">Search Engines</div></div>
    <div id="buttons"></div>
    <div id="restore"><div id="restore_button" class="sprite spr-button_restore"><div class="pa"><?=$restore;?></div></div></div>
  </div>
  <div id="popular"><div><? echo $popSearches ?></div><? echo $keyword_links; ?><div class="gray-dk small" id="trends">provided by Google Trends</div></div>
  <div id="footer"><?=$copyright;?>&nbsp;<a id="feedback" href="#"><?=$me;?></a></div>
  <script type="text/javascript">
    <? $locJS = "function() { iQ.prepLink(this.id); if(allClear) window.location.href = ht+" ?>
    
    doc = document; 
    loc = location;
    var secSprButton="sec sprite spr-button";
    var sprDel="spr spr-del";
    var sprDelShow="spr spr-del-show";
        
    function $(eid) { return doc.getElementById(eid); }
    function _byTag(eid,tag) { return $(eid).getElementsByTagName(tag); }
    function setHTML(target,content) { 
      if(!!$(target)) { $(target).innerHTML = content; } 
    }
    var _asyncRequest = function(url, on_success) {
      var req = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
      req.open("GET", url, true);
      req.onreadystatechange = function(e) {
        if(req.readyState === 4 && req.status === 200) {
          if(on_success) { on_success(req.responseText); }
        }
      };
      req.send(null);
    };
    
    var iQ = {
      init : function() {   
        this.device();     
        <? 
          if(isset($_COOKIE["country"])) {
            $js_country = $_COOKIE["country"];
          } else { 
            $js_country = "us";
          }
        ?>
        this.country = '<?= $js_country ?>';
        this.buildButtons();      
        Cookie.init();     
        this.clearButton(); 
        /*this.searchField();*/
        
        $("edit").onclick = function() { iQ.editStart(); };   
        $("restore_button").onclick = function() { 
          var restore_confirm = confirm("Restore default buttons?");
          if(restore_confirm) {
            Cookie.resetCookie('buttons');
            $("buttons").innerHTML = "";
            iQ.buildButtons();
            iQ.editStart();
          } else {
            return false;
          }
        };
        
        $("sections").addEventListener("click", function() {
          $("iq_input_suggest").style.display="none";
        }, false);
        /*window.addEventListener("scroll", function() {
          $("iq_input_suggest").style.display="none";
        }, false);*/
        
        $("iq_input").disabled = false; 
        $("iq_input").onfocus = function() { iQ.fixTop(); };
        $("iq_input").onblur = function() { setTimeout( function() { $("iq_input_suggest").style.display="none"; $("sections").style.paddingTop="10px"; }, 100); };
        $("iq_input").addEventListener("keyup",function() {
          if($("iq_input").value != "") {
            $("iq_input_suggest").style.display="block";
            $("sections").style.paddingTop="110px";
            $("iq_input_suggest_list").innerHTML = '<div class="loader">Loading...</div>';
            var google_search_xhr = "/suggest/?q="+$("iq_input").value;
            
            _asyncRequest(google_search_xhr, function(response_txt) {
              var keywords_array = eval(response_txt)[1];
              $("iq_input_suggest_list").innerHTML = "";
              for(var x=0;x<keywords_array.length;x++) {
                if(x < 4) {
                  var list_markup = '<li onclick="iQ.populateKeyword(this);">'+keywords_array[x]+'</li>';
                  $("iq_input_suggest_list").innerHTML += list_markup;
                }
              }
            });
            
          } else {
            $("iq_input_suggest").style.display="none";
            $("iq_input_suggest_list").innerHTML = "";
            $("sections").style.paddingTop="10px";
          }
        }, false);
        
        /*$("mag").onclick = function() { $("iq_input").focus(); };*/
        $("feedback").href = 'mailto:'+unescape("%6D%69%6C%6C%61%6E%40%67%6D%61%69%6C%2E%63%6F%6D")+'?subject=<?=$pageTitle;?> <?=$pageTitleB;?>';
        
        if(iQ.device.is_iDevice) {
          /*$("mag").style.visibility="hidden";*/
          $("iq_input").style.padding="4px";
        }
      },
      populateKeyword : function(target) {
        $("iq_input").value = target.innerHTML;
      },
      device : function() {
        this.ua = navigator.userAgent.toLowerCase();
        var iDevices = ["iphone","ipad","ipod"];
        var others = ["android","pre/"];        
        this.list = iDevices.concat(others);
        this.is_iDevice = false;
        
        for(var d=0;d<this.list.length;d++) {
          this["is_"+this.list[d].split(["/"][0])] = this.ua.indexOf(this.list[d]) != -1 ? true : false;
        }        
        for(var dd=0;dd<iDevices.length;dd++) {        
          if(this.ua.indexOf(iDevices[dd]) != -1) {
            this.is_iDevice = true;
            break;
          } 
        }
      },
      editStart : function() {
        $("sections").className = "sections_edit_on";
        $("edit").innerHTML = "<?=$done;?>";
        $("edit").onclick = function() { iQ.editEnd(); };
        $("edit").className = "edit_on";
        $("buttons").style.marginLeft="24px"; $("restore").style.display = $("services_txt").style.display = "block"; $("query").style.display = $("popular").style.display = "none";
        if(!!$("location")) { $("location").style.display = "block"; }
        if(!!$("country")) { $("country").style.display = "block"; }
        if(!!$("promo")) { $("promo").style.display = "none"; }
        $("footer").style.display = "none";
        /*$("mag").style.visibility = "hidden";*/
        $("iq_input").disabled = true;
        this.dels = new this.getButtonElements(sprDel,sprDelShow);
        for(var z=0;z<this.dels.length;z++) {
          this.dels[z].setAttribute((doc.all ? "className":"class"),sprDelShow);
        }
        this.setDels();        
        this.reorderButtons = new this.getButtonElements("reorder","reorder_show");
        for(var zz=0;zz<this.reorderButtons.length;zz++) {
          this.reorderButtons[zz].setAttribute((doc.all ? "className":"class"),"reorder_show");
        }        
        this.setRestores();
        this.eventsOff();
      },
      editEnd : function() {
        $("sections").className = "sections_edit_off";
        $("edit").innerHTML = "<?=$edit;?>";
        $("edit").className = "edit_off";
        $("edit").onclick = function() { iQ.editStart(); };
        $("buttons").style.marginLeft="auto"; $("restore").style.display = $("services_txt").style.display = "none"; $("query").style.display = $("popular").style.display = "block";
        if(!!$("location")) { $("location").style.display = "none"; }
        if(!!$("country")) { $("country").style.display = "none"; }
        if(!!$("promo")) { $("promo").style.display = "block"; }
        $("footer").style.display = "block";
        /*$("mag").style.visibility = "visible";*/
        $("iq_input").disabled = false;
       
        this.dels = new this.getButtonElements(sprDel,sprDelShow);
        for(var z=0;z<this.dels.length;z++) {
          this.dels[z].setAttribute((doc.all?"className":"class"),sprDel);
        } 
        this.reorderButtons = new this.getButtonElements("reorder","reorder_show");
        for(var zz=0;zz<this.reorderButtons.length;zz++) {
          this.reorderButtons[zz].setAttribute((doc.all ? "className":"class"),"reorder");
        }       
        this.eventsOn();
        this.fixTop();
        
        if(iQ.device.is_iDevice) {
          /*$("mag").style.visibility="hidden";*/
        }
      },
      setDels : function() {
        if(!this.dels) {
          this.dels = new this.getButtonElements(sprDel,sprDelShow);
        }  
        for(var z=0;z<this.dels.length;z++) { 
          this.dels[z].onclick = function() { 
            var current_cookie = Cookie.getCookie("buttons").split(",");
            if(current_cookie.length < 2) {
              alert("You really should keep at least one. ;-)");
            } else {
              this.parentNode.style.display = "none"; 
              Cookie.remove(this.parentNode);
            } 
          }; 
        }
      },
      setRestores : function() {
        if(!this.reorderButtons) {
          this.reorderButtons = new this.getButtonElements("reorder","reorder_show");
        }  
        for(var z=0;z<this.reorderButtons.length;z++) { 
          var spans = this.reorderButtons[z].getElementsByTagName("span");
          for(var y=0;y<spans.length;y++) {
            spans[y].onclick = function() {
              var prevButton = false;
              var nextButton = false;
              var direction = this.className.split("reorder_")[1];
              var buttonEle = this.parentNode.parentNode;
              var buttonId = buttonEle.id;
              var iQCookieArray = Cookie.getCookie("buttons").split(",");
              if(buttonEle.previousElementSibling) { prevButton = buttonEle.previousElementSibling.id; }
              if(buttonEle.nextElementSibling) { nextButton = buttonEle.nextElementSibling.id; }                           
              for(var x=0;x<iQCookieArray.length;x++) {
                if(buttonEle.id == iQCookieArray[x]) { break; }
              }                                          
              if(direction=="up" && buttonEle.previousElementSibling) {
                iQCookieArray.splice(x-1,1,buttonId);
                iQCookieArray.splice(x,1,prevButton);
              } else if (direction=="down" && buttonEle.nextElementSibling) {
                iQCookieArray.splice(x,1,nextButton);
                iQCookieArray.splice(x+1,1,buttonId);
              }              
              Cookie.setCookie("buttons",iQCookieArray.join());  
              iQ.buildButtons();
              iQ.editStart();
            };
          }
        }
      },
      getButtonElements : function(offName,onName) {
        this.elements = _byTag("buttons","div");
        elementsArray=[];
        for(var yy=0;yy<this.elements.length;yy++) { 
          if(this.elements[yy].className==offName || this.elements[yy].className==onName) {
            elementsArray.push(this.elements[yy]); 
          }  
        }
        return elementsArray;
      },
      getButtons : function() {
        var buttons = _byTag("buttons","div");
        buttonsArray=[];
        for(var yz=0;yz<buttons.length;yz++) { 
          if(buttons[yz].className==secSprButton) { 
            buttonsArray.push(buttons[yz]); 
          }
        };
        return buttonsArray;
      },
      eventsOff : function() {
        var buttons = new this.getButtons();
        for(var a=0;a<buttons.length;a++) { buttons[a].onclick = null; }
      },
      fixTop : function(top) {
        var y = top ? top : 0;
        setTimeout(function(){window.scrollTo(0, top);}, 1000);
      },  
      clearButton : function() {
        var inputFieldEl = $("iq_input");
        var clearButtonEl = false;
        if(inputFieldEl && typeof inputFieldEl == "object") {
          clearButtonEl = doc.createElement("img");
          clearButtonEl.setAttribute("id","clear_button");
          clearButtonEl.setAttribute("class","search_form_clear");
          clearButtonEl.setAttribute("src","/i/clear.png");
          inputFieldEl.parentNode.appendChild(clearButtonEl);
          var clearImgOffset=inputFieldEl.clientWidth-28;
          clearButtonEl.style.left=clearImgOffset+"px";
          /*clearButtonEl.style.top="7px";*/
          inputFieldEl.addEventListener('keyup', function() { $("clear_button").style.display = (this.value==="") ? "none" : "block"; }, false);
          inputFieldEl.addEventListener('click', function() { $("clear_button").style.display = (this.value==="") ? "none" : "block"; }, false);
        }
        if(clearButtonEl && typeof clearButtonEl == "object") {
          $("clear_button").style.display = (inputFieldEl.value==="") ? "none" : "block";
          clearButtonEl.addEventListener('click', function() {
            $("iq_input").value="";
            $("iq_input").focus();
            $("clear_button").style.display = "none";
          }, false);
        }
      },   
      searchField : function() {
        this.default_text = "Search Term";
        $("iq_input").value = this.default_text;
        $("iq_input").style.color = "#ccc";
        
        $("iq_input").addEventListener("focus",function() {
          if(this.value==iQ.default_text) {
            this.value="";
            this.style.color = "#000";
          }
        },false);
        $("iq_input").addEventListener("blur",function() {
          if(this.value=="") {
            this.value="Search Term";
            this.style.color = "#ccc";
          }
        },false);        
      }, 
      populatePop : function(keyword) { 
        $("iq_input").value=keyword; 
        this.fixTop(); 
				$("iq_input").style.color = "#000";
        $("iq_input").focus(); 
        $("clear_button").style.display = "block"; 
      },
      buildButtons : function() {   
        var new_button = false;  
				if(!!doc.cookie) {
        	var button_ids = unescape(doc.cookie.split("buttons=")[1].split(";")[0]).split(",");
				} else {
					var button_ids = "<?=$default_buttons_cookie?>".split(",");				
				}
        $("buttons").innerHTML = "";
        
        for(var x=0;x<button_ids.length;x++) {
          if(button_ids[x] != "wikitravel") { /* discontinued buttons go here. */
            if(button_ids[x] == "yelp" && this.country != "us") {
              new_button = "";
            } else {
                new_button = '<div id="'+button_ids[x]+'" class="sec sprite spr-button"><div class="spr spr-del">&#215;</div><div class="spr spr-'+button_ids[x]+'"></div><h2 id="pa_'+button_ids[x]+'"></h2> <div id="reorder_'+button_ids[x]+'" class="reorder"><span class="reorder_up">&#9650;</span><span class="reorder_down">&#9660;</span></div></div>';
            }
            $("buttons").innerHTML += new_button;
          }
        }
        this.buttonTxt();
        this.eventsOn();
      },
      buttonTxt : function() {
        setHTML("pa_g",'<?=$google;?> <?=$yourCountry;?>');
        setHTML("pa_gimg",'<?=$googleImgs;?>');
        setHTML("pa_imgur",'<?=$imgur;?>');
        setHTML("pa_reddit",'<?=$reddit;?>');
        setHTML("pa_duckduckgo",'<?=$duckduckgo;?>');
        setHTML("pa_bing",'<?=$bing;?>');        
        setHTML("pa_yelp",'<?=$yelp;?>');
        setHTML("pa_wi",'<?=$wikipedia;?>');
        setHTML("pa_twitter",'<?=$twitter;?>');
        setHTML("pa_youtube",'<?=$youtube;?>');
        setHTML("pa_dict",'<?=$dictionary;?>');
        setHTML("pa_ama",'<?=$amazon;?>');
        setHTML("pa_eb",'<?=$ebay;?>');
        setHTML("pa_f",'<?=$flickr;?>');
        setHTML("pa_y",'<?=$yahoo;?> <?=$yourCountry;?>');
        setHTML("pa_imdb",'<?=$imdb;?>');
        /*setHTML("pa_wikitravel",'<?=$wikitravel;?>');*/
      },
      prepLink : function(eid) {
        ht = "http://"; 
        allClear = false; 
        iQt=$("iq_input").value;
        if($("iq_input").value === "" || $("iq_input").value === "Search Term") { 
          alert("<?=$pleaseType;?>"); 
          this.fixTop(); 
          $("iq_input").focus(); 
          return false; 
        } else { 
          allClear = true; 
        }
        iQt_esc = escape(iQt);
        return allClear, iQt, iQt_esc;
      },
      eventsOn : function() {     
        if(!!$("g")) { $("g").onclick = <?=$locJS;?>"<?=$googleAct;?><?=$googleActB;?>"; }; }
        if(!!$("y")) { $("y").onclick = <?=$locJS;?>"<?=$yahooAct;?><?=$yahooActB;?>"; }; }
        if(!!$("wi")) { $("wi").onclick = <?=$locJS;?>"<?=$wikipediaAct ?><?=$wikipediaActB;?>"; }; }
        if(!!$("dict")) { $("dict").onclick = <?=$locJS;?>"<?=$dictionaryAct;?>"; }; }
        if(!!$("gimg")) { $("gimg").onclick = <?=$locJS;?>"<?=$googleImgsAct;?>/m/search?dc=gorganic&eosr=on&source=mobileproducts&client=<?=$hostName;?>&q="+iQt+"&site=images&sa=X&oi=blended&ct=more-results"; }; }
        if(!!$("bing")) { $("bing").onclick = <?=$locJS;?>"<?=$bingAct;?><?=$bingActB;?>"; }; }
        if(!!$("twitter")) { $("twitter").onclick = <?=$locJS;?>"<?=$twitterAct;?><?=$twitterActB;?>"; }; }
        if(!!$("youtube")) { $("youtube").onclick = <?=$locJS;?>"<?=$youtubeAct;?>"; }; }
        if(!!$("ama")) { $("ama").onclick = <?=$locJS;?>"<?=$amazonAct;?><?=$amazonActB;?>"; }; }
        if(!!$("f")) { $("f").onclick = <?=$locJS;?>"<?=$flickrAct;?>"; }; }       
        if(!!$("eb")) { $("eb").onclick = <?=$locJS;?>"<?=$ebayAct;?><?=$ebayActB;?>"; }; }
        if(!!$("imdb")) { $("imdb").onclick = <?=$locJS;?>"<?=$imdbAct;?>/find?q="+iQt+"&ref=<?=$hostName;?>&sourceid=mozilla-search"; }; }
        if(!!$("imgur")) { $("imgur").onclick = <?=$locJS;?>"<?=$imgurAct;?>"; }; }   
        if(!!$("reddit")) { $("reddit").onclick = <?=$locJS;?>"<?=$redditAct;?>"; }; } 
        if(!!$("duckduckgo")) { $("duckduckgo").onclick = <?=$locJS;?>"<?=$duckduckgoAct;?>"; }; } 
        
        /*if(!!$("wikitravel")) { $("wikitravel").onclick = <?=$locJS;?>"<?=$wikitravelAct;?>"; }; }*/
        <? if(isset($_COOKIE["country"]) && ($_COOKIE["country"] == "us" || $_COOKIE["country"] == "")) {?>if(!!$("yelp")) { $("yelp").onclick = <?=$locJS;?>"<?=$yelpAct;?><?=$yelpActB;?>"+iQ.location; }; }<? } ?>
      }
    };
    
    var Cookie = {
      init : function() {        
        $("edit").style.visibility="visible";
        var date = new Date();
        date.setTime(date.getTime()+(2000*24*60*60*1000));
        this.cookie_data = "domain=<?=$cookieName;?>; path=/; expires="+date.toGMTString();
        this.setCountry();
        this.setLocation();
      },
      remove : function(eleId) {     
        var buttons_cookie = unescape(doc.cookie.split("buttons=")[1].split(";")[0]).split(",");
        var new_buttons_cookie = [];
        for(var x=0;x<buttons_cookie.length;x++) {
          if(buttons_cookie[x] != eleId.id) {
            new_buttons_cookie.push(buttons_cookie[x]);
          }
          this.setCookie("buttons",new_buttons_cookie);
        }    
      },
      resetCookie : function(cookieName) {    
        var cookieVal = false;
        if(cookieName == "buttons") {
          cookieVal="<?=$default_buttons_cookie?>";
        }
        this.setCookie(cookieName,cookieVal);  
      },
      setCookie : function(name,value) { 
        doc.cookie = name+"="+value.toString()+";"+this.cookie_data; 
      },
      getCookie : function(name) {
        return unescape(document.cookie.split(name+"=")[1].split(";")[0]);
      },
      setCountry : function() {
        $("country_select").value="<?=$myCountryCode;?>";
        $("country_select").onchange = function() { 
          Cookie.setCookie("country",this.value);
          location.replace("http://<?=$hostName;?>"); 
        };
      },
      setLocation : function() {
        iQ.location = "<?=$location;?>";
        if(!!$("location_input")) {
          $("location_input").onblur = function() {
            Cookie.setCookie("location",this.value);
            iQ.location = this.value;
          };
        }
      }      
    }; 
           
    iQ.init(); 
    window.onload = function() {
      /*iQ.fixTop(45);*/
    }
  </script>
</body>
