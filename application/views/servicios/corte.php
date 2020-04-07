<div class="row">
	<div class="col-md-11 col-sm-11 col-lg-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1">
		<div class="table-responsive" id="prueba">
			<table class="table table-bordered table-hover table-condesend" id="tablaCorte">
				<caption><span style="color:green;font-weight:bold;">Reporte de servicios entregados de --> <span style="color:red;font-weight:bold;"><?=$fecha1?></span>  -- a --> <span style="color:red;font-weight:bold;"><?=$fecha2?></span> </span></caption>
				<thead>
					<a href="#" id="imp" style="font-weight:bold;">imprimir en ticket</a>
					<tr>
						<td>Folio</td>
						<!--<td>Fecha</td>-->
						<!--<td>Estado</td>-->
						<!--<td>Tipo</td>-->
						<td>Refacciones</td>
						<td>Servicios</td>
						<td >Total</td>
					</tr>
				</thead>
				<?php $total=0;
				  $totalRef=0;	
				  $totalSer=0;
				?>
				<tbody>
					<?php foreach ($query->result() as $row) {?>
					<tr>
						<td><?=$row->folio?></td>
						<!--<td></td>$row->fecha?-->
						<!--<td></td>$row->estadogeneral-->
						<!--<td>$row->tipo</td>-->
						<td><?=$row->subtotal?></td>
						<td><?=$row->total?></td>
						<td><?php $subtotal=$row->subtotal+$row->total; echo $this->cart->format_number($subtotal); $total+=$subtotal;?></td>
						<?php 
							$totalRef=$totalRef+$row->subtotal;
							$totalSer=$totalSer+$row->total;
						?>	
					</tr>
					
					<?php }?>
							
							<tr style="background-color:#cbcbcb;"><td ><b>Totales</b></td><td><b><mark><?php echo '$ '.number_format($totalRef,2); ?></mark></b></td><td><b><mark><?php echo '$ '.number_format($totalSer); ?></mark></b></td><td><mark style="background-color:darkturquoise;color:red;"><?php echo '<b> $ '.$this->cart->format_number($total).'</b>';?></mark></td></tr>
							<?php $t=$this->cart->format_number($total); ?>
				</tbody>	

			</table>
		</div>
	</div>
</div>
<!-- tabla oculta a imprimir -->
<div style="display:none;">
	<table border="1"  id="tablaCorteTicket" style="font-size:10pt;">
		<caption><h3>Reporte de servicios</h3></caption>
		<tr>
			<td>Folio</td>
			<td>Fecha</td>
			<!--<td>Tipo</td>-->
			<td>Refacciones</td>
			<td>Servicios</td>
			<td >Total</td>
		</tr>
		<?php foreach ($query->result() as $row) {?>
		<tr>
		    <td><?=$row->folio?></td>
			<td><?=$row->fecha?></td>
			<!--<td>$row->tipo</td>-->
			<td><?=$row->subtotal?></td>
			<td><?=$row->total?></td>
			<td><?php $subtotal=$row->subtotal+$row->total; echo number_format($subtotal,2);?></td>
		</tr>
					
		<?php }?>
			<tr style="background-color:#cbcbcb;"><td ><b>Totales</b></td><td></td><td><b><mark><?php echo '$ '.number_format($totalRef,2); ?></mark></b></td><td><b><mark><?php echo '$ '.number_format($totalSer); ?></mark></b></td><td><mark style="background-color:darkturquoise;color:red;"><?php echo '<b> $ '.$t.'</b>';?></mark></td></tr>
	</table>
</div>

<!--  *** fin tabla oculta para imprimir -->
</div>
</body>
</html>