                                                            <!--begin: Datatable-->
                                                            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
																<thead>
																	<tr>
																		<th title="Field #1">Date / Reference</th>
																		<th title="Field #2">Previous Balance</th>
																		<th title="Field #3">Amount</th>
																		<th title="Field #4">New Balance</th>
																		<th title="Field #5">Type</th>
																		<th title="Field #6">Status</th>
																	</tr>
																</thead>
																<tbody>
																	<?php if($histories !== false){
																		
																	 	foreach ($histories as $history) {?>
																			<tr>
																				<td><?php echo $utility->niceDateFormat($history['date']).'<br><br><strong>'.$history['reference']?></strong></td>
																				<td><?php echo $appInfo->currency_code?><?php echo $history['old_balance']?></td>
																				<td><?php echo $appInfo->currency_code?><?php echo $history['amount']?></td>
																				<td><?php echo $appInfo->currency_code.$history['balance_after']?></td>
																				<td class="text-center"><?php echo $history['method']?></td>
																				<td class="text-center"><?php echo $history['status']?></td>
																			</tr>
																		<?php } ?>
																	<?php } ?>
																</tbody>
															</table>
															<!--end: Datatable-->