<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"E:\GitHub\vote\public/../application/web\view\user\edit.html";i:1519641956;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>个人信息</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/mui.css" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/border.css"/>
		<script type="text/javascript" src="__WEB__/js/jquery.js"></script>
		<script type="text/javascript" src="__WEB__/js/picture/tooles.js"></script>
		<script type="text/javascript" src="__WEB__/js/picture/picture.js"></script>
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
			#nextview{
				width: 80px;
				height: 80px;
				border-radius:50% ;
			}
			#upFile{
				width: 65%;
				height: 80px;
				position: absolute;
				top: 10px;
				left: 30%;
				z-index: 100;

				opacity: 0;

			}
			#tishi{
				position: absolute;
				top: 40px;
				left: 65%;
				opacity: 0.5;
				font-size: 14px;
				z-index: 20;
			}

		</style>
	</head>
	<body>
		<header class="mui-bar mui-bar-nav">
					<div class="div" onclick="history.go(-1);"></div>
					<h1 class="mui-title mui-active">个人信息</h1>
					<!--<a class=" mui-pull-right mui-btn-link">提现记录</a>-->
				</header>
				<div class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll">
		<form class="mui-input-group">
				<div class="mui-input-row" style="height: auto; position: relative; padding: 10px 0px;">
					<label style="margin-top: 20px;">头像</label>


					<input class="" type="file" id="upFile" />
							<!--所选文件压缩前预览-->
							<!--<h3>压缩前预览：</h3>-->
							<!--<img src="" id="preview" style="width: 100%; display: none;" />-->

							<!--所选文件压缩后预览-->
							<!--<h3>压缩后预览：</h3>-->
							<img src="__WEB__/img/painting/gh/timg (7).jpg" id="nextview"  />
							<span id="tishi" >
								更换头像
							</span>
				</div>
				<div class="mui-input-row">
					<label>昵称</label>
					<input id='name' type="text" class="mui-input-clear mui-input" placeholder="请输入昵称" maxlength="10" value="昵称">
				</div>
				<div class="mui-input-row">
					<label>姓名</label>
					<input  type="text" class="mui-input-clear mui-input" placeholder="请输入姓名" value="雷人" readonly="readonly">
				</div>
				<div class="mui-input-row mui-input-rows">
					<label>手机号</label>
					<input  type="number" class="mui-input-clear mui-input" placeholder="请输入手机号" value="13203940281" readonly="readonly">
				</div>

				<div class="mui-input-row mui-input-rows">
					<label>身份证号</label>
					<input  type="number" class="mui-input-clear mui-input" placeholder="请输入手机号" value="412723199511297734" readonly="readonly">
				</div>

			</form>
								<div class="mui-content-padded">
				<button id='reg' class="mui-btn mui-btn-primary" style="width: 90%;margin-left: 5%;">保存</button>
			</div>
							</div>

						</div>
						<script src="__WEB__/js/mui.js" type="text/javascript" charset="utf-8"></script>
						<script type="text/javascript">
							mui(".mui-content-padded").on("tap", "#reg", function() {

								if($("#name").val()!= ""){
									window.top.location.href = "<?php echo url('user/index'); ?>";
								}else{
									mui.toast('请输入昵称')
								}
							})
						</script>
	</body>
</html>
