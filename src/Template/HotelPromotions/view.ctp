<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<!--<div class="box-header with-border">
					<i class="fa fa-plus"></i> <b>View Hotel Promotion</b>
				</div> -->
				<div class="box-body"> 
					<center><fieldset>
						<legend style="color:#369FA1;"><b> &nbsp; <?= __('View Hotel Details ') ?> &nbsp;  </b></legend>
							<table class="table">
								<tr>
									<th scope="row"><?= __('User') ?></th>
									<td><?= h($hotelPromotion->user->first_name.' '.$hotelPromotion->user->last_name.'( '.$hotelPromotion->user_rating.' )');?></td>
									<th scope="row"><?= __('Hotel Name') ?></th>
									<td><?= h($hotelPromotion->hotel_name) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Location') ?></th>
									<td><?= h($hotelPromotion->hotel_location) ?></td>
									<th scope="row"><?= __('Hotel Category') ?></th>
									<td><?= $hotelPromotion->has('hotel_category') ? $this->Html->link($hotelPromotion->hotel_category->name, ['controller' => 'HotelCategories', 'action' => 'view', $hotelPromotion->hotel_category->id]) : '' ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Website') ?></th>
									<td><?= h($hotelPromotion->website) ?></td>
									<th scope="row"><?= __('Hotel Rating') ?></th>
									<td><?= $this->Number->format($hotelPromotion->hotel_rating) ?></td>
								
								</tr>
								<tr>
									<th scope="row"><?= __('Promotion Duration') ?></th>
									<td><?=h($hotelPromotion->price_master->week); ?></td>
									<th scope="row"><?= __('Visible Date') ?></th>
									<td><?= date('d-M-Y',strtotime($hotelPromotion->visible_date)); ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Cheap Tariff') ?></th>
									<td><?= $this->Number->format($hotelPromotion->cheap_tariff) ?></td>
									<th scope="row"><?= __('Expensive Tariff') ?></th>
									<td><?= $this->Number->format($hotelPromotion->expensive_tariff) ?></td>
								</tr>
								<tr>
									
									<th scope="row"><?= __('Total Charges') ?></th>
									<td><?= $this->Number->format($hotelPromotion->total_charges) ?></td>
										<th scope="row"><?= __('Payment Status') ?></th>
									<td><?= h($hotelPromotion->payment_status) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Pic') ?></th>
									<td><?= $this->Html->image('../images/PostTravelPackages/8/test/image/8.jpg',['style'=>'width:20%']) ?></td>
									
								</tr>
							</table>
						</fieldset>
					</center>
				</div>
			</div>
		</div>
	</div>
</section>
							