{include file="header.tpl"}
	<div class="well well-large">
	<div class="row-fluid">

		<div class="span6">
			<div class="title_name">
			<i class="cominfo"></i>
			<h4>快递公司信息</h4>
			</div>
			<div class="form-group">
				<label>快递服务(POST Service):</label>
				<select class="selectpicker" width="300" name="expressid" id="expressid">
					<option id="airMail" value="airMail">Australia Post Air Mail</option>
					<option id="ems" value="ems">AusPost Express Courier</option>
					<option id="lantian" value="lantian">墨尔本蓝天快递</option>
					<option id="lantian" value="ace">墨尔本ACE快递</option>
					<option id="fangzhou" value="fangzhou">墨尔本方舟速递</option>
					<option id="auexpress" value="auexpress">墨尔本AuExpress快递</option>
				</select>
			</div>
			<div class="form-group" >
				<label>请输入单号：</label>
				<input name="expressno" type="text" length="20" id="expressno" value="" placeholder="请输入单号" />
			</div>
			<div class="form-group" >
				<label>请输入验证码：</label>
				<input name="captcha" type="text" length="20" value="" placeholder="请输入验证码" />
				<img src="captcha.php" id="captcha" />
			</div>
			<button value="查询" id="btnSnap" class="btn" type="submit">查询</button>  
		</div>
		<div class="span6">
			<div class="title_name">
				<span class="glyphicon glyphicon-cloud"></span>
				<h4>搜索历史</h4><span>*.当你清除浏览器历史，搜索历史将会消失</span>
			</div>
			<div id="search_history">
				<ul></ul>
			</div>
			
		</div>
	</div>
		</div>
	<div class="well well-large">
		<div id="retData"></div>
	</div>

{literal}
    <script language="javascript">
	$(document).ready(function() {
		$("#btnSnap").click(function() {
			var captcha = $("#captcha").prev('input').val();
			if($("#captcha").is(":visible") && captcha.length == 0) {
				return TipNotAllowEmpty('captcha', '请输入验证码');
			}
			var expressno = $("#expressno").val();
			if(expressno.length == 0) {
				return TipNotAllowEmpty('expressno', '请输入快递单号');
			}
                        
			$("#retData").html('查询中...');
			var expressid = $("#expressid").val();
			$.get("get.php",{'com':expressid, 'nu':expressno, 'captcha':captcha},
				function(data) {
					$("#retData").html(data);
				}
			);
			
			$("#search_history").hide().html(expressno).fadeIn('fast');
			
			
			
			return false;
		});
		$('#expressid').change(function(){
			if($(this).val() == 'airMail') {
				$('#captcha').parent().show();
			} else {
				$('#captcha').parent().hide();
			}
			// 搜索历史
			showSearchHistory($(this).val());
		});
		$('#captcha').click(function(){
			$(this).attr('src', $(this).attr('src') + '?'+ Math.random());
		});
		function TipNotAllowEmpty(id, msg) {
			$('#'+id).focus();
			$("#retData").html(msg);
		}
		function getcookie(name) {
			var cookie_start = document.cookie.indexOf(name);
			var cookie_end = document.cookie.indexOf(";", cookie_start);
			return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
		}
		function showSearchHistory(type) {
			var history = getcookie('search_history');
			$('#search_history').html('');
			if(history.length == 0)
				return false;
			history = eval('('+history+')');
			history = history[type];
			if(typeof history == 'undefined' || history.length == 0)
				return false;
			var list = '';
			for(var i in history) {
				list += '<li><span class="label-info" href="javascript:;" data-node="label">'+history[i].label+'</span>';
				list += ' <a  href="javascript:;" data-node="nu">'+i+'</a>';
				list += ' <a href="javascript:;" class="btn btn-success" data-node="editlabel">备注</a>';
				list += ' <a href="javascript:;" class="btn btn-danger" data-node="del" data-nu="'+i+'">删除</a>';
				list += '</li>';
			}
			$('#search_history').html(list);
			$('#search_history').find('a[data-node="del"]').click(function(){
				var obj = $(this);
				var nu = obj.parent('li').find('a[data-node="nu"]').html();
				var expressid = $("#expressid").val();
				$.post("search_history.php",{'com':expressid, 'nu':nu, 'action':'del'},
					function(data) {
						if(data == 1)
							obj.parent('li').remove();
					}
				);
			});
			$('#search_history').find('a[data-node="editlabel"]').click(function(){
				var obj = $(this);
				var nu = obj.parent('li').find('a[data-node="nu"]').html();
				var label = obj.parent('li').find('span[data-node="label"]').html();
				if(label.length == 0)
					label = window.prompt("提示", "请输入备注");
				else
					label = window.prompt("提示", label);
				if(label.length == 0)
					return false;
				var expressid = $("#expressid").val();
				$.post("search_history.php",{'com':expressid, 'nu':nu, 'label':label, 'action':'edit'},
					function(data) {
						if(data == 1) {
							obj.parent().find('span[data-node="label"]').html(label);
						}
					}
				);
			});
			$('#search_history').find('a[data-node="nu"]').click(function(){
				var obj = $(this);
				var nu = obj.html();
				$('#expressno').val(nu);
				$('#btnSnap').click();
			});
		}
		showSearchHistory($('#expressid').val());
	});
	</script>

   {/literal}

{include file="footer.tpl"}