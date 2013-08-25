{include file="header.tpl"}

 <!-- Example row of columns -->
      		<div class="accordion" id="price">
			  <div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#price" href="#airMail"><h4><img src="../assets/img/ap_airmail.jpg" />Australia Post Air Mail</h4></a>
			     </div>
			    <div id="airMail" class="accordion-body collapse">
			      <div class="accordion-inner">
					<table class="table table-hover">
						  <thead>
					          <tr>
					        	<th>Price Range</th>
					            <th>Australia Post Air Mail Price  <img src="../assets/img/alert.jpeg" alt="expect delivery day" id="airMail_edd" rel="tooltip" title="预计送达时间6-10个工作日"   width="20px"/></th>
					            <th>Our Air Mail Price</th>
					            <th>您节省了</th>
					           </tr>
					        </thead>
					        
					{section name=price loop=$price}
					
						 <tbody>
					       	<tr class="success">
					        	<td>{$price[price].weightRange}</td>
					        	<td>AU${$price[price].ausPostAirPrice}</td>
					        	<td>AU${$price[price].ourAirPrice}</td>								<td>AU${math equation="{$price[price].ausPostAirPrice} - {$price[price].ourAirPrice}" format="%.2f"}</td>
					       	</tr>
					 	 </tbody>

					{/section}
					</table>
					

					
				     </div>
				    </div>
				  </div>
				  
			<div class="accordion-group">
			    <div class="accordion-heading">
			      <a class="accordion-toggle" data-toggle="collapse" data-parent="#price" href="#express"><h4><img src="../assets/img/ap-express-courier.jpg" alt="ap-express-courier" width="" height="" />Australia Post Express Courier International</h4></a>
			    </div>
			    <div id="express" class="accordion-body collapse">
			      <div class="accordion-inner">
      					<table class="table table-hover">
						  <thead>
					          <tr>
					        	<th>Price Range</th>
					            <th>AuPost Express Courier International Price<img src="../assets/img/alert.jpeg" alt="expect delivery day" id="exp_edd" rel="tooltip" title="预计送达时间4-6个工作日"   width="20px"/></th>
					            <th>Our Express Price</th>
					            <th>您节省了</th>
					          </tr>
					        </thead>
					      
					{section name=price loop=$price}
						 <tbody>
						 	<tr class="warning">
						 		<td>{$price[price].weightRange}</td>
					        	<td>AU${$price[price].ausPostExpPrice}</td>
					        	<td>AU${$price[price].ourExpPrice}</td>								<td>AU${math equation="{$price[price].ausPostExpPrice} - {$price[price].ourExpPrice}" format="%.2f"}</td>		
						 	</tr>
						 </tbody>

					{/section}
					</table>
				 {$pageup}{$pagedown}{$pageconfig}

			 </div>
    </div>
  </div>
</div>
	{literal}
    <script language="javascript">
	$(document).ready(function()
	{        
		$('#airMail_edd').tooltip({
		  'selector': '',
		  'placement': 'bottom'
		});
        $('#exp_edd').tooltip({
		  'selector': '',
		  'placement': 'bottom'
		});
	});
	</script>
   {/literal}	
{include file="footer.tpl"}
