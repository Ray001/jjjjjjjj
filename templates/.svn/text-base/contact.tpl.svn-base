{include file="header.tpl"}
 <div class="span8">
    <form id="contact_form" action="processing.php" method="POST" class="well form-horizontal">
    	 <div class="control-group">
		    <label class="control-label" for="shop">澳洲邮政(Australia POST)代收点</label>
			    <div class="controls">
			    		<select id="shop" name="shop">
			    			<option value="" disabled="true" selected="">--选择离您最近的代收点--</option>	
							<option value="pointcook">Point Cook</option>
<!-- 							<option value="footscray">Footscray</option> -->
						</select>
			    </div>
		</div>
	    <div class="control-group">
		    <label class="control-label" for="name">姓名(Name)</label>
			    <div class="controls">
			    	<input type="text" id="name" placeholder="姓名" name="name">
			    </div>
		</div>
	    <div class="control-group">
		    <label class="control-label" for="phone">电话(可选)</label>
		    <div class="controls">
		    	<input  id="tel" name="phone" placeholder="电话">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="email">邮箱(Email)</label>
		    <div class="controls">
		    	<input type="email" id="email" name="email" placeholder="邮箱" >
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="message">Message</label>
		    <div class="controls">
		    	<textarea id="message" rows="10" name="message"></textarea>
		    </div>
		</div>
		
		 <div class="control-group">
			<div class="controls">
			<button type="submit" class="btn" data-loading-text="Submitting...">提交(Submit)</button>
			<button type="rest" class="btn">重置(Reset)</button>
			</div>
		 </div>
		 <div class="control-group"><div class="controls" id="submitMsg"></div></div>
  </form>
   </div>
   <div class="well span4">
    	<div id="footscray" class="shop" style="display:none">
    	<address> 
	    	<h4><strong>澳洲邮政代收点：{$footscray.name}</strong></h4><br>
	    	地址(Address): {$footscray.address}<br>
	    	电话(Phone):<br>Shop: {$footscray.phone.home} / Mobile:{{$footscray.phone.mobile}}<br>
	    	邮箱(Email)：<a href="mailto:{$footscray.email}">{$footscray.email}</a>
    	</address>
    	<div id="footscray-map-canvas"></div>
    	</div>
    	<div id="pointcook" class="shop" style="display:none">
    	<address> 
	    	<h4><strong>澳洲邮政代收点：{$laverton.name}</strong></h4><br>
	    	地址(Address): {$laverton.address}<br>
	    	电话(Phone):<br>Alicia: {$laverton.phone.Alicia} / Hao:{{$laverton.phone.Hao}}<br>
	    	邮箱(Email)：<a href="mailto:{$laverton.email}">{$laverton.email}</a>
    	</address>
    	<div id="map-canvas"></div>
    	</div>
    </div>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script> 
	{literal}
    <script>  
		$('#shop').change(function(){
            $('.shop').hide();
            $('#' + $(this).val()).show();
        });
		$('#contact_form').ajaxForm({
			target: '#submitMsg',
			success: function(responseText, statusText, xhr, $form){
				
			}
		});
       $('#contact_form').validate({
			rules: {
				shop:{
					required: true
				},
				name: {
					minlength: 2,
					required: true,
					name: true
					},
				email: {
					required: true,
					email: true
					},
				message: {
					minlength: 2,
					required: true
				}
			},
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
	});
	
	</script>
   {/literal}
 	
{include file="footer.tpl"}