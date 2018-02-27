<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"E:\GitHub\vote\public/../application/web\view\qunying\info.html";i:1519639988;}*/ ?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<title>作品</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/mui.css" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/style.css" />
		<style type="text/css">
			.mui-preview-image.mui-fullscreen {
				position: fixed;
				z-index: 20;
				background-color: #000;
			}

			.mui-preview-header,
			.mui-preview-footer {
				position: absolute;
				width: 100%;
				left: 0;
				z-index: 10;
			}

			.mui-preview-header {
				height: 44px;
				top: 0;
			}

			.mui-preview-footer {
				height: 50px;
				bottom: 0px;
			}

			.mui-preview-header .mui-preview-indicator {
				display: block;
				line-height: 25px;
				color: #fff;
				text-align: center;
				margin: 15px auto 4;
				width: 70px;
				background-color: rgba(0, 0, 0, 0.4);
				border-radius: 12px;
				font-size: 16px;
			}

			.mui-preview-image {
				display: none;
				-webkit-animation-duration: 0.5s;
				animation-duration: 0.5s;
				-webkit-animation-fill-mode: both;
				animation-fill-mode: both;
			}

			.mui-preview-image.mui-preview-in {
				-webkit-animation-name: fadeIn;
				animation-name: fadeIn;
			}

			.mui-preview-image.mui-preview-out {
				background: none;
				-webkit-animation-name: fadeOut;
				animation-name: fadeOut;
			}

			.mui-preview-image.mui-preview-out .mui-preview-header,
			.mui-preview-image.mui-preview-out .mui-preview-footer {
				display: none;
			}

			.mui-zoom-scroller {
				position: absolute;
				display: -webkit-box;
				display: -webkit-flex;
				display: flex;
				-webkit-box-align: center;
				-webkit-align-items: center;
				align-items: center;
				-webkit-box-pack: center;
				-webkit-justify-content: center;
				justify-content: center;
				left: 0;
				right: 0;
				bottom: 0;
				top: 0;
				width: 100%;
				height: 100%;
				margin: 0;
				-webkit-backface-visibility: hidden;
			}

			.mui-zoom {
				-webkit-transform-style: preserve-3d;
				transform-style: preserve-3d;
			}

			.mui-slider .mui-slider-group .mui-slider-item img {
				width: auto;
				height: auto;
				max-width: 100%;
				max-height: 100%;
				object-fit: cover;
			}

			.mui-android-4-1 .mui-slider .mui-slider-group .mui-slider-item img {
				width: 100%;
			}

			.mui-android-4-1 .mui-slider.mui-preview-image .mui-slider-group .mui-slider-item {
				display: inline-table;
			}

			.mui-android-4-1 .mui-slider.mui-preview-image .mui-zoom-scroller img {
				display: table-cell;
				vertical-align: middle;
			}

			.mui-preview-loading {
				position: absolute;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: none;
			}

			.mui-preview-loading.mui-active {
				display: block;
			}

			.mui-preview-loading .mui-spinner-white {
				position: absolute;
				top: 50%;
				left: 50%;
				margin-left: -25px;
				margin-top: -25px;
				height: 50px;
				width: 50px;
			}

			.mui-preview-image img.mui-transitioning {
				-webkit-transition: -webkit-transform 0.5s ease, opacity 0.5s ease;
				transition: transform 0.5s ease, opacity 0.5s ease;
			}

			@-webkit-keyframes fadeIn {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}

			@keyframes fadeIn {
				0% {
					opacity: 0;
				}
				100% {
					opacity: 1;
				}
			}

			@-webkit-keyframes fadeOut {
				0% {
					opacity: 1;
				}
				100% {
					opacity: 0;
				}
			}

			@keyframes fadeOut {
				0% {
					opacity: 1;
				}
				100% {
					opacity: 0;
				}
			}

			p img {
				max-width: 100%;
				height: auto;
			}

			.mui-slider-img-content {
				position: absolute;
				bottom: 10px;
				left: 10px;
				right: 10px;
				color: white;
				text-align: center;
				line-height: 21px
			}

			.spans {
				display: flex;
				justify-content: center;
			}

			.spans .mui-icon {
				width: 30px;
				height: 30px;
				text-align: center;
				line-height: 25px;
				border-radius: 50%;
				margin-bottom: 10px;
			}
			.mui-media-body{
				text-align: center;
				font-size: 18px;
			}
			.mui-media-body P{
				text-align:left;
				margin-top: 10px;
				font-size: 15px;
			}
			.mui-card .mui-card{
				margin:0px ;
				box-shadow: 0px 1px 2px rgba(0, 0, 0, 0);
				padding: 10px 0px;
				border-top: 1px solid rgba(0, 0, 0, .3);
				/*border-top: 1px solid gray;
				border-bottom: 1px solid gray;*/
			}
			.mui-card .mui-card .mui-col-sm-6{
				text-align: center;
			}
			.mui-card .mui-card .mui-col-sm-6:nth-child(2){
				color: #007aff;
			}
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
		</style>
	</head>

	<body>
		<!--
	      index1.html
	      <project>

	      Created by Administrator on 2018-01-18.
	      Copyright 2018 Administrator. All rights reserved.
	 -->

		<!-- 主界面菜单同时移动 -->
		<!-- 侧滑导航根容器 -->
		<div class="mui-off-canvas-wrap mui-draggable">
			<!-- 主页面容器 -->
			<div class="mui-inner-wrap">
				<!-- 菜单容器 -->

				<!-- 主页面标题 -->
				<header class="mui-bar mui-bar-nav">
					<div class="div" onclick="history.go(-1);"></div>
					<h1 class="mui-title mui-active">作品</h1>
				</header>

				<!-- 主页面内容容器 -->
				<div class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll">
						<!-- 主界面具体展示内容 -->
						<!--九宫格1-->
						<!--下拉刷新容器-->

						<ul class="mui-media " style="padding: 0;">

							<!--<div class="mui-card mui-row" style="padding: 10px;">
								<div class="mui-col-sm-6 mui-col-xs-6">
									当前票数
								</div>
								<div class="mui-col-sm-6 mui-col-xs-6"   >
									150
								</div>
							</div>-->
							<div class="mui-card" id="ones">

								<!--页眉，放置标题-->
								<!--<div class="mui-card-header">页眉</div>-->
								<!--内容区-->
								<div class="mui-card-content">
									<a href="#"><img src="__WEB__/img/painting/gh/faedab64034f78f0aab4203a73310a55b2191cbf.jpg" data-preview-src="" data-preview-group="1" /></a>
								</div>
								<!--页脚，放置补充信息或支持的操作-->
								<div class="mui-media-body" style="padding: 10px;">
									名家字画
									<p style="text-indent:2em;"> 吴败，字国旗，号画魔,云南江川人。4岁学习书画，其人画画成魔，15年不出家门。读周易，悟太极，理解宇宙变化原理，融和中国传统山水，花鸟。启功先生观其书画，书赠“少年老成”四字，既表认同，更多激励。中国艺术大师朱纪瞻先生在上海为吴败题写了“滇南鬼才”四字，以奖励后生。

									</p>
								</div>
<div class="mui-card mui-row" >
								<div class="mui-col-sm-6 mui-col-xs-6">
									当前票数
								</div>
								<div class="mui-col-sm-6 mui-col-xs-6"   >
									150
								</div>
							</div>
							</div>

						</ul>

					</div>
				</div>
				<div class="mui-off-canvas-backdrop"></div>
				<div class="mui-backdrop" style="display: none;">

				</div>
			</div>
		</div>

		<script src="__WEB__/js/mui.js" type="text/javascript" charset="utf-8"></script>

		<script src="__WEB__/js/mui.zoom.js"></script>
		<script src="__WEB__/js/mui.pre.js"></script>
		<script>
			mui.previewImage();
		</script>
		<script type="text/javascript">
			mui.init();
			(function($) {
				$(".mui-scroll-wrapper").scroll({
					//bounce: false,//滚动条是否有弹力默认是true
					//indicators: false, //是否显示滚动条,默认是true
				});
			})(mui);
			//mui下a标签href失效问题解决
			mui('body').on('tap', 'a', function() {
				window.top.location.href = this.href;
				/*$(this).classList.remove("mui-active") */
			});
			var ons = 3;
			var onl;
			//var mask = mui.createMask(callback);//callback为用户点击蒙版时自动执行的回调；
			mui(".mui-media").on("tap", ".mui-media .mui-card .spans .mui-icon", function() {
				//当前对象直接就是--->this
				var sq = this;
				var tt = this.className.length;

				if(tt > 32) {

				} else {
					if(ons > 0) {

						this.classList.add('active');
						ons = ons - 1;
						/*alert(this.className.length)
						this.classList.add('active');
						ons = ons-1;
						alert(this.className.length)*/
					} else {
						/*alert("123123")*/
						//mask.show();//显示遮罩

						mui.toast('已使用完每天三次的点赞功能', {
							duration: 'long',
							type: 'div'
						})

					}

				}

			});
		</script>
	</body>

</html>