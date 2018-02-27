<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\GitHub\vote\public/../application/web\view\gold\index.html";i:1519640752;}*/ ?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<title>黄金榜</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/mui.css" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/style.css" />
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
			.mui-grid-9 li {
				width: 20%;
			}

			.mui-grid-9>li:nth-child(11),
			.mui-grid-9>li:nth-child(19) {
				margin-left: 20% !important;
			}
			.mui-grid-9>.mui22{
				width: 26.5%;
			}

			#card ul {
				float: left;
			}

			#jiu li a {
				padding: 5px 0 !important;
			}

			#jiu li a .mui-media-body {
				margin: 0 !important;
				padding: 5px 0 !important;
				height: auto;
			}

			.spans {
				display: flex;
				justify-content: center;
			}

			.spans span {
				line-height: 25px;
			}

			.spans .mui-icon {
				width: 30px;
				height: 30px;
				text-align: center;
				line-height: 25px;
				font-size: 18px;
				border-radius: 50%;
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

				<!-- 主页面标题 -->
				<header class="mui-bar mui-bar-nav">
					<div class="div" onclick="history.go(-1);"></div>
					<h1 class="mui-title mui-active">黄金榜</h1>
				</header>

				<!-- 主页面内容容器 -->
				<div id="pullrefresh" class="mui-content mui-scroll-wrapper">
					<div class="mui-scroll">
						<!-- 主界面具体展示内容 -->
						<!--九宫格1-->
						<ul class="mui-table-view mui-grid-view mui-grid-9" id="jiu">
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3 onclis">
								<a href="#">
									<div class="mui-media-body onclis">诗：</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body active" id="act">古风诗</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">近体诗</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">格律诗</div>
								</a>
							</li> <br />
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3 onclis">
								<a href="#">
									<div class="mui-media-body onclis">书：</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">楷书</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">行书</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">草书</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">隶书</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">篆书</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">魏碑</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3">
								<a href="#">
									<div class="mui-media-body">毛体</div>
								</a>
							</li> <br />
							<li class="mui-table-view-cell mui-media mui-col-xs-3 mui-col-sm-3 onclis">
								<a href="#">
									<div class="mui-media-body onclis">画：</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media    mui22">
								<a href="#">

									<div class="mui-media-body">写意山水</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media   mui22">
								<a href="#">

									<div class="mui-media-body">写意花鸟</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media  mui22 ">
								<a href="#">
									<div class="mui-media-body">写意人物</div>
								</a>
							</li>

							<li class="mui-table-view-cell mui-media   mui22">
								<a href="#">

									<div class="mui-media-body">工笔山水</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media   mui22">
								<a href="#">

									<div class="mui-media-body">工笔花鸟</div>
								</a>
							</li>
							<li class="mui-table-view-cell mui-media mui22 ">
								<a href="#">
									<div class="mui-media-body">工笔人物</div>
								</a>
							</li>
						</ul>
						<ul class="mui-table-view mui-grid-view mui-grid-9" id="card">
							<ul class=" mui-media mui-col-xs-6 mui-col-sm-6" id="card1">
								<div class="mui-card" id="ones">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/faedab64034f78f0aab4203a73310a55b2191cbf.jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/timg (15).jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/timg (1).jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/timg (10).jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/timg (12).jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
							</ul>
							<ul class="mui-media mui-col-xs-6 mui-col-sm-6" id="card2">
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/timg (16).jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/timg (6).jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"> <img src="__WEB__/img/painting/gh/timg (8).jpg" /> </div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"><img src="__WEB__/img/painting/gr/timg (26).jpg" /></div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
								<div class="mui-card">
									<a href="<?php echo url('gold/info'); ?>">
										<div class="mui-card-content"><img src="__WEB__/img/painting/gs/u=1012637593,3984533236&fm=27&gp=0.jpg" /></div>
										<div class="mui-card-footer">名称</div>
									</a>
								</div>
							</ul>
						</ul>
					</div>
				</div>

		<script src="__WEB__/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<script src="__WEB__/js/mui.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			mui.init();
mui.init({
				swipeBack: false,
				pullRefresh: {
					container: '#pullrefresh',
					down: {
						style:'circle',
						callback: pulldownRefresh
					},
					up: {
						contentrefresh: '正在加载...',
						callback: pullupRefresh
					}
				}
			});
			/**
			 * 下拉刷新具体业务实现
			 */
			function pulldownRefresh() {
				setTimeout(function() {
					var table = document.body.querySelector('.mui-table-view');
					var cells = document.body.querySelectorAll('.mui-table-view-cell');
					for(var i = cells.length, len = i + 3; i < len; i++) {
						/*var li = document.createElement('li');
						li.className = 'mui-table-view-cell';
						li.innerHTML = '<a class="mui-navigate-right">Item ' + (i + 1) + '</a>';
						//下拉刷新，新纪录插到最前面；
						table.insertBefore(li, table.firstChild);*/
					}
					mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
					mui.toast('下拉刷新成功');
				}, 1000);
			}
			var count = 0;
			/**
			 * 上拉加载具体业务实现
			 */
			function pullupRefresh() {
				setTimeout(function() {
					mui('#pullrefresh').pullRefresh().endPullupToRefresh((++count > 4)); //参数为true代表没有更多数据了。 加载次数·
					var table = document.body.querySelector('#card1 ');
					var cells = document.body.querySelectorAll('#card1 .mui-card');
					var table2 = document.body.querySelector('#card2');
					var cells2 = document.body.querySelectorAll('#card2 .mui-card');


					for(var i = cells.length, len = i + 4; i < len; i++) {
						var li = document.createElement('div');
						li.className = 'mui-card';
						li.innerHTML = '<div class="mui-card-content"><a href="<?php echo url('gold/info'); ?>"><img src="__WEB__/img/painting/gr/timg (26).jpg" /></a></div><div class="mui-card-footer">名称</div>';
						var b = i % 2;
						if(b==0){
							table2.appendChild(li);
						}else{
							table.appendChild(li);
						}

					}
				}, 1000);
			}
//			(function($) {
//				$(".mui-scroll-wrapper").scroll({
					//bounce: false,//滚动条是否有弹力默认是true
					//indicators: false, //是否显示滚动条,默认是true
//				});
//			})(mui);
			//mui下a标签href失效问题解决
			mui('body').on('tap', 'a', function() {
					window.top.location.href = this.href;
					/*$(this).classList.remove("mui-active") */

				}

			);
			var tt = 0;
			var t1;
			mui(".mui-table-view ").on("tap", ".mui-table-view-cell a .mui-media-body", function() {
				//当前对象直接就是--->this

				if(tt > 0) {
					t1.classList.remove("active");
				}
				var th = this.classList.contains('onclis'); //return true or false
				if(th ==  false){
					var act = document.getElementById("act");act.classList.remove("active");
				t1 = this;
				this.classList.add('active');
				tt = tt + 1;
				}
				/*var act = document.getElementById("act");act.classList.remove("active");
				t1 = this;
				this.classList.add('active');
				tt = tt + 1;*/
				/*mui.alert(username,"this");*/
				/*alert(this.target)*/ //a href
				/*//修改弹出框默认input类型为password
			mui.prompt('text','deftext','title',['true','false'],null,'div')
			document.querySelector('.mui-popup-input input').type='password' */

			});

			//mask.close();//关闭遮罩
			var ons = 3;
			var onl;
			//var mask = mui.createMask(callback);//callback为用户点击蒙版时自动执行的回调；
			mui("#card ").on("tap", ".mui-media .mui-card .mui-icon", function() {
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