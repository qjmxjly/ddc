<?php
require_once("./autoload.php");

$mqtt_server = "47.93.240.240:1883";


use \sskaje\mqtt\MQTT;
use \sskaje\mqtt\MessageHandler;

//use \sskaje\mqtt\Debug;

$mqtt = new MQTT($mqtt_server);

//Debug::Enable();
//Debug::SetLogPriority(Debug::NOTICE);
//Debug::Log(Debug::INFO, "QoS=1");


$step = intval($_REQUEST['step']);
$carId = intval($_REQUEST['ddcid']);

if (empty($step)) $step = 1;


if($step == 1) {
    
    if ($mqtt->connect()) {
        $mqtt->publish_sync("/ddc/ningbo/10001","action",1,0);
        $mqtt->disconnect();
    }
    
} elseif($step ==2) {

	$retData = array();
	$ret = '';
	$topics['/ddc/ningbo/10001/status'] = 0;

	if($mqtt->connect()){
		$mqtt->publish_sync("/ddc/ningbo/10001","ready",1,0);


		class MySubscribeCallback extends MessageHandler
		{

		    public function publish(MQTT $mqtt, sskaje\mqtt\Message\PUBLISH $publish_object)
		    {
		    	global $ret, $mqtt,$topics;
		    	$ret = $publish_object->getMessage();
		    	$mqtt->unsubscribe(array_keys($topics));
		        /*printf(
		            "got a message:(msgid=%d, QoS=%d, dup=%d, topic=%s) %s\n",
		            $publish_object->getMsgID(),
		            $publish_object->getQoS(),
		            $publish_object->getDup(),
		            $publish_object->getTopic(),
		            $publish_object->getMessage()
		        );*/

		    }
		}

	  	$mqtt->subscribe($topics);

		$callback = new MySubscribeCallback();
		$mqtt->setHandler($callback);
		$mqtt->loop();

	}
	if(!empty($ret)) {
		$retData['status'] = 'ok';
	}
	
	echo json_encode($retData);
	exit;

}


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
        <div class="page page-current" id="page-first">
        <!-- 你的html代码 -->
			<div class="content">
				<div class="content-block-title">
						<h3>请选择游戏时长：</h3>
				</div>
			  <div class="list-block media-list inset">
			    <ul>
			      <li>
			        <a class="item-link item-content">
			          <div class="item-media"><img src="https://gd4.alicdn.com/imgextra/i4/362352354/TB2F2XdmR4lpuFjy1zjXXcAKpXa_!!362352354.jpg_50x50.jpg" style='width: 2.2rem;'></div>
			          <div class="item-inner">
			            <div class="item-title-row">
			              <div class="item-title">5分钟</div>
			              <div class="item-after"><font color="red">30元</font></div>
			            </div>
			            <div class="item-subtitle">大约绕赛场2圈</div>
			          </div>
			        </a>
			      </li>
			    </ul>
			  </div>
			  
			  <div class="list-block media-list inset">
			    <ul>
			      <li>
			        <a  class="item-link item-content">
			          <div class="item-media"><img src="https://gd4.alicdn.com/imgextra/i4/362352354/TB2F2XdmR4lpuFjy1zjXXcAKpXa_!!362352354.jpg_50x50.jpg" style='width: 2.2rem;'></div>
			          <div class="item-inner">
			            <div class="item-title-row">
			              <div class="item-title">10分钟</div>
			              <div class="item-after"><font color="red">50元</font></div>

			            </div>
			            <div class="item-subtitle">大约绕赛场4圈</div>
			          </div>
			        </a>
			      </li>
			    </ul>
			  </div>

			  <div class="list-block media-list inset">
			    <ul>
			      <li>
			        <a  class="item-link item-content">
			          <div class="item-media"><img src="https://gd4.alicdn.com/imgextra/i4/362352354/TB2F2XdmR4lpuFjy1zjXXcAKpXa_!!362352354.jpg_50x50.jpg" style='width: 2.2rem;'></div>
			          <div class="item-inner">
			            <div class="item-title-row">
			              <div class="item-title">15分钟</div>
			              <div class="item-after"><font color="red">70元</font></div>
			            </div>
			            <div class="item-subtitle">大约绕赛场6圈</div>
			          </div>
			        </a>
			      </li>
			    </ul>
			  </div>

			  <div class="card">
			    <div class="card-content">
			      <div class="card-content-inner">  <span class="icon icon-message"></span>
					您选择的是编号<?php echo $carId;?>的嘟嘟车，车辆会有语音提示，在支付成功后即可开动。</div>
			    </div>
			  </div>

			</div>


        </div>

        <!-- 第二页 -->
        <div class="page" id="page-second">
        	<div class="">
			<div class="content">
				<div class="content-block-title">
					<h3>确认支付信息：</h3>
				</div>
				<div class="card">
					<div class="card-header">
						您选择的小车如下：
					</div>
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
						                <div class="item-title">时长：5分钟（大约可以绕场2圈）</div>
						              </div>
						              <div class="item-subtitle">消费：<font color="red">30元</font></div>
						            </div>
						          </li>
						        </ul>
						      </div>
			      		</div>
			    	</div>
			  	</div>
			  	<div class="content-block">
			    	<p><a href="#" class="button button-fill button-big">去支付 </a></p>

			    </div>
			    <div class="content-block">
					<a class="button-nav pull-right back">
					      <span class="icon icon-left"></span>
					      返回上一页
					</a>

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
    	
    $(document).on('click','#page-first .list-block a', function () {
	    $.showPreloader('请稍后，请求信息中');

	    var params = {};

	    var errCallback = function() {
	    	$.toast("小车可能不能正常使用,请换一辆车或联系管理员。", 2000,'success');
	    };

	    $.ajax({
		    url: 'index.php?step=2',
		    type: "post",
		    contentType: 'application/json;charset=utf-8',
		    dataType: 'json',
		    timeout: 7000,
		    data: JSON.stringify(params),
		    success: function(data) {
		        setTimeout(function() {
					$.hidePreloader();
			    	if(!data) errCallback();
		        	$.router.load("#page-second");  //加载内联页面
				}, 1000);
    		},
    		error: function(data) {
    			setTimeout(function() {
					$.hidePreloader();
    				errCallback();
    			}, 1000);
    		}

		});
	  });

    </script>

  </body>
</html>