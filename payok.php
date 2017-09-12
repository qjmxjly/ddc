<?php
require_once("./autoload.php");
require_once("./config.php");


$time = intval($_REQUEST['time']);
if(empty($time)) $time = 3600*10*1000;

use \sskaje\mqtt\MQTT;
use \sskaje\mqtt\MessageHandler;

//use \sskaje\mqtt\Debug;

$mqtt = new MQTT($mqtt_server);

//Debug::Enable();
//Debug::SetLogPriority(Debug::NOTICE);
//Debug::Log(Debug::INFO, "QoS=1");

$carId = intval($_REQUEST['ddcid']);
if(empty($carId)) $carId = 10001;

$city = 'ningbo';

$mqtt->connect();
$mqtt->publish_sync("/ddc/ningbo/10001/go",$time,1,0);
$mqtt->disconnect();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>嘟嘟车</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <css 

  </head>
  <body>
    <div class="page-group">

        <!-- 第二页 -->
        <div class="page" id="page-second">
        	<div class="">
			<div class="content">
				<div class="card">
			    	<div class="card-content">
			      		<div class="card-content">
				      		<div class="list-block media-list">
						        <ul>
						          <li class="item-content">
						            <div class="item-media">
						              <img src="https://gd4.alicdn.com/imgextra/i4/362352354/TB2F2XdmR4lpuFjy1zjXXcAKpXa_!!362352354.jpg_50x50.jpg" width="50">
						            </div>
						            <div class="item-inner">
						              <div class="item-title-row">
						                <div class="item-title">支付完成，现在小车手可以出发了。</div>
						              </div>
						            </div>
						          </li>
						        </ul>
						      </div>
			      		</div>
			    	</div>
			  	</div>
			</div>

        </div>



    </div>

    <script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    
    <script type="text/javascript">

    document.body.addEventListener('touchmove' , function(e){
    e.preventDefault();
	})
    	
 
    </script>

  </body>
</html>