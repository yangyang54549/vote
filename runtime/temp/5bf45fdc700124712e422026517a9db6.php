<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"E:\GitHub\vote\public/../application/web\view\pay\addbank.html";i:1519642512;}*/ ?>
<!DOCTYPE html>
<html class="ui-page-login">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>添加银行卡</title>
		<link href="__WEB__/css/mui.min.css" rel="stylesheet" />
		<link href="__WEB__/css/style.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="__WEB__/css/border.css"/>
		<style>
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
			.area {
				margin: 20px auto 0px auto;
			}

			.mui-input-group:first-child {
				margin-top: 20px;
			}

			.mui-input-group label {
				width: 35%;
			}

			.mui-input-row label~input,
			.mui-input-row label~select,
			.mui-input-row label~textarea {
				width: 65%;
			}

			.mui-checkbox input[type=checkbox],
			.mui-radio input[type=radio] {
				top: 6px;
			}

			.mui-content-padded {
				margin-top: 25px;
			}

			.mui-btn {
				padding: 10px;
			}

			.mui-input-rows {
				position: relative;
			}

			.mui-input-rows #wait {
				position: absolute;
				top: 5px;
				right: 10px;
				height: 30px;
				width: 70px;
				text-align: center;
				background-color: #007aff;
				color: white;
				padding: 0;
				border-radius: 10px;
				line-height: 30px;
				font-size: 12px;
			}

			/*.mui-input-row
			 {
				height: auto !important;
				padding: 10px 0 !important;
			}
			*/
			#mui_view {
				position: fixed;
				top: 0;
				left: 0;
				width: 100vw;
				height: 100vh;
				transition: all .5s ease-in .1s;
				box-sizing: border-box;
				padding: 44px 20px 0;
				display: none;
			}

			.mui-table-view-cell.mui-active {
				background-color: #0062CC;
			}
		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<div class="div" onclick="history.go(-1);"></div>
			<h1 class="mui-title">添加银行卡</h1>
		</header>
		<div class="mui-content">
			<form class="mui-input-group" style="margin: 10px;">
				<div class="mui-input-row">
					<label>姓名</label>
					<input id='name' type="text" class="mui-input-clear mui-input" placeholder="请输入姓名" maxlength="10">
				</div>
				<div class="mui-input-row mui-input-rows">
					<label>手机号</label>
					<input id='phone' type="number" class="mui-input-clear mui-input" placeholder="请输入手机号" oninput="if(value.length>11)value=value.slice(0,11)">
				</div>

				<div class="mui-input-row">
					<label>银行卡号</label>
					<input id='identity' type="tel" class="mui-input-clear mui-input" placeholder="请输入银行卡号" maxlength="18">
				</div>
				<div class="mui-input-row">
					<label>开户行</label>
					<input type="text" class="mui-input-clear" id="xuan" placeholder="请选择银行">
				</div>
			</form>
			<div class="mui-content-padded" style="margin: 10px;">
				<button id='reg' class=" mui-btn-primary" style="width: 100%; ">添加</button>
			</div>

			<ul class="mui-table-view" id="mui_view">
				<li class="mui-table-view-cell">中国邮政储蓄银行<input type="hidden" name="" id="" value="1" /></li>
				<li class="mui-table-view-cell">中国农业银行<input type="hidden" name="" id="" value="2" /></li>
				<li class="mui-table-view-cell">中国工商银行<input type="hidden" name="" id="" value="3" /></li>
				<li class="mui-table-view-cell">建设银行<input type="hidden" name="" id="" value="4" /></li>
				<li class="mui-table-view-cell">招商银行<input type="hidden" name="" id="" value="5" /></li>
				<li class="mui-table-view-cell">交通银行<input type="hidden" name="" id="" value="6" /></li>
				<li class="mui-table-view-cell">中国银行<input type="hidden" name="" id="" value="7" /></li>
				<li class="mui-table-view-cell">中国民生银行 <input type="hidden" name="" id="" value="8" /></li>
				<li class="mui-table-view-cell">中国光大银行<input type="hidden" name="" id="" value="9" /></li>
				<li class="mui-table-view-cell">华夏银行<input type="hidden" name="" id="" value="10" /></li>
				<li class="mui-table-view-cell">广东发展银行<input type="hidden" name="" id="" value="12" /></li>
				<li class="mui-table-view-cell">福建兴业银行<input type="hidden" name="" id="" value="13" /></li>
				<li class="mui-table-view-cell">深圳市商业银行<input type="hidden" name="" id="" value="14" /></li>
				<li class="mui-table-view-cell">广州市商业银行<input type="hidden" name="" id="" value="15" /></li>
				<li class="mui-table-view-cell">中信实业银行<input type="hidden" name="" id="" value="16" /></li>
				<li class="mui-table-view-cell">农村信用社<input type="hidden" name="" id="" value="17" /></li>
				<li class="mui-table-view-cell">上海浦东发展银行<input type="hidden" name="" id="" value="18" /></li>
				<li class="mui-table-view-cell">上海银行<input type="hidden" name="" id="" value="19" /></li>

			</ul>
		</div>
		<script src="__WEB__/js/mui.min.js"></script>
		<script src="__WEB__/js/app.js"></script>
		<script>
			mui(".mui-input-row").on("tap", "#xuan", function() {
				document.getElementById("mui_view").style.display = "block";
			})
			mui("#mui_view").on("tap", "#mui_view li", function() {
			//mui.toast(this.firstChild.value);
			//this.firstChild.value
			document.getElementById("xuan").value = this.innerText;
			document.getElementById("mui_view").style.display = "none";

			})
			mui(".mui-content-padded").on("tap", "#reg", function() {
				var name = document.getElementById("name");
				var phone = document.getElementById("phone");
				var identity = document.getElementById("identity");
				var yh = document.getElementById("xuan");


					if(name.value != "" || name.value.length > 1) {
						if(!(/^1[3456789]\d{9}$/.test(phone.value))) {
							mui.toast('手机号错误，请重新输入');
						} else {

								if(identity.value != "" || identity.value.length == 18) {
									if(yh.value !="") {
										mui.toast('添加成功');
										window.top.location.href = "tx-jl.html";
									} else {
										mui.toast('请选择银行');
									}
								} else {
									mui.toast('请输入银行卡号');
								}

						}
					} else {
						mui.toast('请重新输入姓名');
					}

				/*if(!(/^1[3456789]\d{9}$/.test(phone.value))) {
						mui.toast('手机号错误，请重新输入');
					} else {
						mui.toast('已发送短信');
						this.value = "已发送";
					}*/
			})
		</script>
	</body>

</html>