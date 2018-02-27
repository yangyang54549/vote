<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"E:\GitHub\vote\public/../application/web\view\pay\list.html";i:1519642648;}*/ ?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<title>银行卡</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/mui.css" />

		<style type="text/css">
			header>.div {

				position: absolute;
				top: 15px;
				left: 15px;
				transform: rotate(45deg);
				-ms-transform: rotate(45deg);
				/* IE 9 */
				-moz-transform: rotate(45deg);
				/* Firefox */
				-webkit-transform: rotate(45deg);
				/* Safari 和 Chrome */
				-o-transform: rotate(45deg);
				/* Opera */
				width: 13px;
				height: 13px;
				border-bottom: 2px solid #007aff;
				border-left: 2px solid #007aff;
				z-index: 100;
			}
			.mui-row .mui-col-sm-6,.mui-row .mui-col-xs-6{
				margin-top: 10px;
			}
			.mui-row{
				margin: 10px; background-color: white;
			}
			.mui-col-sm-4 img, .mui-col-xs-4 img{
				width: 40px;
				height: 40px;
				margin: 20px ;
			}
			#wu{
			width: 100%;
			height: 30vh;
			text-align: center;
			font-size: 20px;
			color: #007aff;
			line-height: 30vh;
			display: none;
			}
		</style>
	</head>

	<body>
		<!-- 主界面菜单同时移动 -->
		<!-- 侧滑导航根容器 -->
		<div class="mui-off-canvas-wrap mui-draggable">
			<!-- 主页面容器 -->
			<div class="mui-inner-wrap">
				<!-- 菜单容器 -->
				<aside class="mui-off-canvas-left" id="offCanvasSide">
					<div class="mui-scroll-wrapper">
						<div class="mui-scroll">
							<!-- 菜单具体展示内容 -->

						</div>
					</div>
				</aside>
				<!-- 主页面标题 -->
				<header class="mui-bar mui-bar-nav">
					<div class="div" onclick="history.go(-1);"></div>
					<h1 class="mui-title mui-active">  银行卡</h1>
					<!--<a class=" mui-pull-right mui-btn-link">提现记录</a>-->
				</header>

				<!-- 主页面内容容器 -->
				<div class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll">
						<!-- 主界面具体展示内容 -->
						<div class="mui-row" style="background-color: rgba(0,0,0,0);  line-height: 15px; font-size: 15px;color: #8f8f94;">点击可申请提现（长按删除）
						<p id="wu">暂无记录</p>
						</div>
						<a href="<?php echo url('pay/withdraw'); ?>" class="rows">
						<div class="mui-row"  >
							<div class="mui-col-sm-4 mui-col-xs-4">
								<img src="__WEB__/img/png/10.png"  />
							</div>
							<div class="mui-col-sm-6 mui-col-xs-6">
								<h4 style="line-height: 30px; margin-top:5px ; color: black;">中国农业银行</h4>
								<p style="line-height: 20px;">尾号为3045的储蓄卡</p>
							</div>
						</div></a>
						<a href="<?php echo url('pay/withdraw'); ?>" class="rows">
						<div class="mui-row"  >
							<div class="mui-col-sm-4 mui-col-xs-4">
								<img src="__WEB__/img/png/11.png"  />
							</div>
							<div class="mui-col-sm-6 mui-col-xs-6">
								<h4 style="line-height: 30px; margin-top:5px ; color: black;">中国农业银行</h4>
								<p style="line-height: 20px;">尾号为3045的储蓄卡</p>
							</div>
						</div></a>
						<a href="<?php echo url('pay/withdraw'); ?>" class="rows">
						<div class="mui-row"  >
							<div class="mui-col-sm-4 mui-col-xs-4">
								<img src="__WEB__/img/png/12.png"  />
							</div>
							<div class="mui-col-sm-6 mui-col-xs-6">
								<h4 style="line-height: 30px; margin-top:5px ; color: black;">中国农业银行</h4>
								<p style="line-height: 20px;">尾号为3045的储蓄卡</p>
							</div>
						</div></a>

						<!--<div id="demo1" class="mui-progressbar mui-progressbar-infinite">
							<span></span>
						</div>-->
						<button type="button" type="submit" class="mui-btn mui-btn-primary" style="width: 90%;margin-left: 5%;">添加银行卡</button>
						<!--<div id="demo12" class="mui-progressbar">
	<span></span>
</div>-->
					</div>
				</div>
				<div class="mui-off-canvas-backdrop"></div>
			</div>
		</div>
		<script src="__WEB__/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<script src="__WEB__/js/mui.js" type="text/javascript" charset="utf-8"></script>
		<script src="__WEB__/js/muis.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			mui.init()
			mui('.mui-input-row input').input();
//			mui("#demo1").progressbar().show();
			/*mui("#demo12").progressbar({
				progress: 50
			}).show();
*/
mui.init({
gestureConfig:{
tap: true, //默认为true
doubletap: true, //默认为false
longtap: true, //默认为false
swipe: true, //默认为true
drag: true, //默认为true
hold:false,//默认为false，不监听
release:false//默认为false，不监听
}
});

mui('.mui-scroll').on('longtap', '.rows', function() {
	var th = this;
				mui.confirm("确认删除？", '删除', ['取消', '确认'], function(e) {

					if(e.index == 0) {
						//点击取消	this.text("123123");
						setTimeout(function(){
									mui.toast('取消删除');
								},1000);

					} else {

						//确认
						th.remove();
						var ss = document.getElementsByClassName("rows").length;
						if(ss<1){
							document.getElementById("wu").style.display = "block";
						}
						setTimeout(function(){
									mui.toast('删除成功');
								},1000);


					}
				}, 'div');
				//mui.toast('取消删除成功');
			});
mui('body').on('tap','a',function(){window.top.location.href=this.href;});
			mui('.mui-scroll').on('tap', '.mui-btn-primary', function() {
				var th = document.getElementById("number");
				var muiscroll = document.getElementsByClassName("mui-scroll");

				if(muiscroll.length>3){
					mui.toast('最多有四条记录')
				}else{
					/*mui.toast('可添加记录')*/
					window.top.location.href = "<?php echo url('pay/addbank'); ?>";
				}

			});
		</script>
	</body>

</html>