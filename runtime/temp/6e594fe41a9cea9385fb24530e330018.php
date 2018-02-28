<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"E:\GitHub\vote\public/../application/web\view\match\index.html";i:1519812251;}*/ ?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<title>参赛</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/mui.css" />

		<link type="text/css" rel="stylesheet" href="__WEB__/css/uploadsingleimg.css">
		<link type="text/css" rel="stylesheet" href="__WEB__/css/bootstrap.css">
		<!--自行修改input样式-->

		<script type="text/javascript" src="__WEB__/js/jquery.js"></script>
		<script type="text/javascript" src="__WEB__/js/picture/tooles.js"></script>
		<script type="text/javascript" src="__WEB__/js/picture/picture.js"></script>
		<style type="text/css">
			body {
				/*font-family: "楷体","楷体_GB2312";*/
				font-family: 楷体_GB2312, 楷体;
			}

			input {
				height: 36px;
				line-height: 36px;
			}

			.mui-row {
				margin: 10px;
				background-color: white;
				box-sizing: border-box;
				padding: 5px 10px;
			}

			#upFile {
				position: absolute;
				top: 0px;
				left: 0px;
				width: 100%;
				height: 250px;
				opacity: 0;
			}

			.ns {
				opacity: 0;
			}

			.muiinp {
				margin-bottom: 0px !important;
			}

			.muip {
				color: black;
				font-weight: bold;
				margin: 0;
				padding: 5px 0px;
			}

			#mui_view {
				position: fixed;
   				left: 0;
   				top: 0;
				width: 100vw;
				height: auto;
				/*transition: all .5s ease-in .1s;
				box-sizing: border-box;*/
				padding: 0px;
				display: none;
				/*background-image: url(__WEB__/img/painting/gr/u=10131947,1032570421&fm=27&gp=0.jpg);*/
			}

			.mui-table-view-cell:after {
				opacity: 0;
			}

			.mui-table-view-cell {
				border-top: 1px solid #c8c7cc;
			}

			.mui-table-view-cell.mui-active {
				background-color: #0062CC;
			}

			#nextview {
				width: 100%;
				height: auto;
			}



			.mui-bar-tab {
				top: 0px;
			}
		</style>

	</head>

	<body>
		<!-- 主界面移动、菜单不动 -->
		
				<!-- 主页面标题 -->
				<!--<header class="mui-bar mui-bar-nav">

					<h1 class="mui-title">我要参赛</h1>
				</header>-->
				<nav class="mui-bar mui-bar-tab">
					<a class="mui-tab-item " href="<?php echo url('index/index'); ?>">
						<!--<span class="mui-icon mui-icon-home"></span>-->
						<span class="mui-tab-label">首页</span>
					</a>
					<a class="mui-tab-item mui-active" href="<?php echo url('match/index'); ?>">
						<!--<span class=" mui-icon mui-icon-upload"></span>-->
						<span class="mui-tab-label">我要参赛</span>
					</a>
					<!--<a class="mui-tab-item">
						<span class="mui-icon mui-icon-email"></span>
						<span class="mui-tab-label">邮件</span>
					</a>-->
					<a class="mui-tab-item" href="<?php echo url('user/index'); ?>">
						<!--<span class="mui-icon mui-icon-contact"></span>-->
						<span class="mui-tab-label">个人中心</span>
					</a>
				</nav>
				<div class="mui-content mui-scroll-wrapper" style="padding-top: 50px;">
					<div class="mui-scroll">
						<!-- 主界面具体展示内容 -->
						<form class="mui-row" id="from">

							<!--文件选择input-->
							<!--<h3>文件选择：</h3>-->
							<input class="btn btn-default mui-col-sm-12 mui-col-xs-12" type="file" id="upFile" />
							<!--所选文件压缩前预览-->
							<!--<h3>压缩前预览：</h3>-->
							<img src="" id="preview" style="width: 100%; display: none;" />

							<!--所选文件压缩后预览-->
							<!--<h3>压缩后预览：</h3>-->
							<img src="__WEB__/img/a11.png" id="nextview" />
							<p class="mui-col-sm-12 mui-col-xs-12 muip">作品名称</p>
							<input class="mui-col-sm-12 mui-col-xs-12 muiinp" name="title" id="name" type="text" value="" placeholder="输入作品名称" maxlength="10" />
							<p class="mui-col-sm-12 mui-col-xs-12 muip">作品简介</p>
							<textarea name="content" rows="3" cols="" id="text_s" placeholder="输入作品简介" maxlength="150"></textarea>
							<input type="text" name="leixing" id="leixing" value="" placeholder="选择分类" style="margin: 10px 0;" readOnly='readOnly' />
							<!--文件选择input中已选择文件重置(采用form表单的reset重置按钮重置)-->

							<!--<h3>重置文件选择：</h3>-->
							<input class="btn btn-default mui-col-sm-6 mui-col-xs-6 ns" type="reset" id="reBtn" value="清空" />

							<!--提交压缩后的base64文件数据给后台-->
							<!--<h3>传给后台</h3>-->
							<input class="btn btn-default mui-col-sm-6 mui-col-xs-6 ns" type="button" id="upTo" value="提交" />
							<button type="button" id="submit" class="mui-btn mui-btn-primary" style="width: 90%;margin-left: 5%;margin-bottom: 15px;">确认提交</button>
							<!--后台所要获取的文件base64-->
							<!--<h3>后台获取base64文件数据：(一个隐藏域)</h3>-->
							<input id="imgOne" name="imgOne" type="hidden" />

						</form>
						<ul class="mui-table-view" id="mui_view">
							<?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<li class="mui-table-view-cell" data-type = "<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							<input type="hidden" name="" id="mui_views" value="" />
						</ul>
					</div>
				</div>
			
		<script src="__WEB__/js/mui.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			mui.init();
			var up = document.getElementById("upFile");
			var preview = document.getElementById("preview");
			up.style.height = preview.style.height;
			(function($) {
				$(".mui-scroll-wrapper").scroll({
					// bounce: false,//滚动条是否有弹力默认是true
					// indicators: false, //是否显示滚动条,默认是true
				});
			})(mui);

			//mui下a标签href失效问题解决
			mui('body').on('tap', 'a', function() {
				window.top.location.href = this.href;
			});
			mui(".mui-row").on("tap", "#leixing", function() {
				document.getElementById("mui_view").style.display = "block";
			})

			mui("#mui_view").on("tap", "#mui_view li", function() {
				var datas = this.getAttribute("data-type");
				document.getElementById("leixing").value = this.innerText;
				document.getElementById("mui_views").value = this.getAttribute("data-type");
				document.getElementById("mui_view").style.display = "none";
				
			})
			var img = document.getElementById("nextview");
			var ss = img.src;
			var ss1 = ss.substring(ss.lastIndexOf("/") + 1);
			mui(".mui-row").on("tap", "#submit", function() {
				var s = img.src;
				var s1 = s.substring(s.lastIndexOf("/") + 1);

				var name = document.getElementById("name");
				var tes = document.getElementById("text_s");
				var lei = document.getElementById("leixing");
				if(ss1 == s1) {
					mui.toast('请上传图片')
				} else {
					if(name.value != "") {
						if(tes.value != "") {
							if(lei.value != "") {
								/*获取值*/
								var Names = name.value;
								var leis = lei.value;
								var tess = tes.value;
								mui.toast('提交完成');
								/*清空*/
								document.getElementById("nextview").src = "__WEB__/img/a11.png";							
								name.value = "";
								lei.value = "";
								tes.value = "";
								/*跳转*/
								setTimeout(function() {
									window.top.location.href = "zuopin.html";
								}, 1000);
								
							} else {
								mui.toast('请选择分类')
							}
						} else {
							mui.toast('请输入作品简介')
						}
					} else {
						mui.toast('请输入作品名称')
					}
				}
			})
		</script>
	</body>

</html>