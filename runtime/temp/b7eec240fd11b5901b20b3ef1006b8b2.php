<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\GitHub\vote\public/../application/web\view\user\index.html";i:1519697767;}*/ ?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<title>个人中心</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/mui.css" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/style.css" />
		<style type="text/css">
			.row .mui-col-sm-4 {
				line-height: 80px;
			}

			.row {
				margin: 10px;
				background-color: rgba(255, 255, 255, .35);
				border-radius: 10px;
				padding: 10px;
			}

			.row a {
				float: right;
				margin-right: 10px;
			}

			.mui-table-view .mui-table-view-cell .mui-navigate-right .mui-icon {
				margin-right: 5px;
			}

			.mui-table-view .mui-row {
				display: flex;
				justify-content: space-between;
			}

			.mui-table-view .mui-row a {
				display: flex;
				justify-content: center;
				line-height: 30px;
				margin: -10px 0;
			}
			#jf{
				height: 80px;
				padding: 15px 0px;
				box-sizing: border-box;
			}
			#jf a{
				color: black;
				line-height: 25px;
				width: 100%;
				text-align: center;
				font-size: 15px;
			}#jf a:nth-child(2){
				opacity: 0.8;
			}
		</style>
	</head>

	<body>
		<!--
		      index.html
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
				<!--<aside class="mui-off-canvas-left" id="offCanvasSide">
					<div class="mui-scroll-wrapper">
						<div class="mui-scroll">-->
				<!-- 菜单具体展示内容 -->

				<!--</div>
					</div>
				</aside>-->
				<!-- 主页面标题 -->
				<!--<header class="mui-bar mui-bar-nav">
					<a class="mui-icon mui-action-menu mui-icon-bars mui-pull-left" href="#offCanvasSide"></a>
					<h1 class="mui-title">标题</h1>
				</header>-->
				<nav class="mui-bar mui-bar-tab">
					<a class="mui-tab-item " href="<?php echo url('index/index'); ?>">
						<span class="mui-icon mui-icon-home"></span>
						<span class="mui-tab-label">首页</span>
					</a>
					<a class="mui-tab-item" href="<?php echo url('match/index'); ?>">
						<span class=" mui-icon mui-icon-upload"></span>
						<span class="mui-tab-label">我要参赛</span>
					</a>
					<!--<a class="mui-tab-item">
						<span class="mui-icon mui-icon-email"></span>
						<span class="mui-tab-label">邮件</span>
					</a>-->
					<a class="mui-tab-item mui-active" href="<?php echo url('user/index'); ?>">
						<span class="mui-icon mui-icon-contact"></span>
						<span class="mui-tab-label">个人中心</span>
					</a>
				</nav>
				<!-- 主页面内容容器 -->
				<div class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll">
						<!-- 主界面具体展示内容 -->
						<!--轮播-->
						<!--图文表格  ms  -->

						<div class="mui-row row">
							<div class="mui-col-sm-4 mui-col-xs-4">
								<a href="<?php echo url('user/edit'); ?>">
								<span class="imgs" style="display: block; width: 80px; height: 80px;border-radius:50% ; overflow: hidden;">

									<img src="__WEB__/img/painting/gh/timg (7).jpg" id="trueimg" width="100" height="100" />
								</span></a>
							</div>
							<div class="mui-col-sm-4 mui-col-xs-4">
								<!-- <a class="mui-navigate-right">Item 1</a>-->
								昵称
							</div>

							<div class="mui-col-sm-4 mui-col-xs-4" id="jf">
								<a class="" >
									一勺积分
								</a>
								<a class="" >
									120积分
								</a>

							</div>
						</div>
						<!--<p style="margin: 10px; text-indent:1em;">实名认证后才可购买</p>-->
						<!--<ul class="mui-table-view" style="margin: 10px;">

							<li class="mui-table-view-cell mui-row">
								<a href="cz.html" class=" mui-col-sm-6 mui-col-xs-6" style="border-right:1px solid rgba(0,0,0,0.2) ;">
									<span class="mui-icon mui-icon-download"></span><span>充值</span>
								</a>
								<a href="tx-jl.html" class=" mui-col-sm-6 mui-col-xs-6">
									<span class="mui-icon mui-icon-upload"></span><span>提现</span>
								</a>
							</li>

						</ul>-->

    <div class="mui-row mui-table-view-cell" style="margin: 10px; background-color: white;border-top:1px solid rgba(0,0,0,0.2) ;border-bottom:1px solid rgba(0,0,0,0.2) ;">
        <div class="mui-col-sm-6 mui-col-xs-6" >
            <li class="mui-table-view-cell" style="list-style:none;border-right:1px solid rgba(0,0,0,0.2) ;">
                <a class="mui-navigate-right" href="<?php echo url('pay/pay'); ?>" style="padding: 0px 20px;">
                   <span class="mui-icon mui-icon-download"></span><span>充值</span>
                </a>
            </li>
        </div>
        <div class="mui-col-sm-6 mui-col-xs-6">
            <li class="mui-table-view-cell" style="list-style:none;">
                <a class="mui-navigate-right" href="<?php echo url('pay/list'); ?>" style="padding: 0px 20px;">
                    <span class="mui-icon mui-icon-upload"></span><span>提现</span>
                </a>
            </li>
        </div>
    </div>

						<ul class="mui-table-view" style="margin: 10px;">
							<li class="mui-table-view-cell">
								<a class="mui-navigate-right" href="<?php echo url('production/index'); ?>">
									<span class="mui-icon mui-icon-compose"></span> 我的作品
								</a>
							</li>
							<li class="mui-table-view-cell">
								<a class="mui-navigate-right" href="<?php echo url('order/index'); ?>">
									<span class="mui-icon mui-icon-email"></span>我的订单
								</a>
							</li>
							<li class="mui-table-view-cell">
								<a href="<?php echo url('address/index'); ?>" class="mui-navigate-right">
									<span class="mui-icon mui-icon-location"></span>收货地址
								</a>
							</li>
							<li class="mui-table-view-cell">
								<a class="mui-navigate-right" href="<?php echo url('login/edit'); ?>">
									<span class="mui-icon mui-icon-gear"></span>修改密码
								</a>
							</li>
						</ul>
						<ul class="mui-table-view" style="margin: 10px;">

							<li class="mui-table-view-cell" id="quit">
								<a class="mui-navigate-right" href="#">
									<span class="mui-icon mui-icon-undo"></span>退出
								</a>
							</li>
						</ul>

					</div>
				</div>
				<div class="mui-off-canvas-backdrop"></div>
			</div>
		</div>

		<!--mui-toast-container mui-ative-->

		<script src="__WEB__/js/mui.js" type="text/javascript" charset="utf-8"></script>
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
			});
			mui('.mui-table-view').on('tap', '#quit', function() {
				mui.confirm("确认退出当前账户？", '提示', ['取消', '确认'], function(e) {
					if(e.index == 0) {
						//点击取消	this.text("123123");
					} else { //确认
						window.top.location.href = "<?php echo url('login/login'); ?>";
					}
				}, 'div');
			});
			mui('.row  .mui-col-sm-4').on('tap', '.imgs', function() {
				window.top.location.href = "img.html";
			});
		</script>
	</body>

</html>