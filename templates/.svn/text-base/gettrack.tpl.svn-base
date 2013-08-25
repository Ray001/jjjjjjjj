<div>
	{$msg}
</div>
{if $result|@count neq 0}
<table width="98%" border="1" align="center" cellspacing="0" cellpadding="1">
	<tbody>
		<tr class="TH_tr">
			<td width="150" height="25" bgcolor="#E6E6E6" align="center"><strong>日期时间</strong></td>
			<td width="350" bgcolor="#E6E6E6" align="center" ><strong>服务地点</strong></td>
			<td bgcolor="#E6E6E6" align="center"><strong>详细内容</strong></td>
		</tr>
		{foreach from=$result item=info}
		<tr align="center">
			<td align="center">{$info.time}</td>
			<td align="left">{$info.location}</td>
			<td align="left">{$info.desc}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{else}
<div>
<ul>
	 <li>对不起，查不到你的订单</li>
	 <li>请正确填写你的运单号</li>
	 <li>查询时请核对网上信息与发单上是否一致</li>
	 <li>如果在此系统中没有查询到我的货物,请与快递公司工作人员联系</li>
</ul>
<div>
{/if}
<br />
<div>
	{$powered}
</div>
