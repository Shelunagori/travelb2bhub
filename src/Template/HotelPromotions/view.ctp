<section class="content">
<div class="row">
	<div class="col-md-12">
			<div class="box box-primary">
				<!--<div class="box-header with-border">
					<i class="fa fa-plus"></i> <b>View Hotel Promotion</b>
				</div> -->
				<div class="box-body"> 
					<form action="<?php echo $coreVariable['SiteUrl'];?>api/hotel_promotions/add.json" method="post" enctype="multipart/form-data">
					<center><fieldset>
						<legend style="color:#369FA1;"><b> &nbsp; <?= __('View Hotel Details ') ?> &nbsp;  </b></legend>
							<table class="table">
								<tr>
									<th scope="row"><?= __('User') ?></th>
									<td><?= $hotelPromotion->has('user') ? $this->Html->link($hotelPromotion->user->last_name, ['controller' => 'Users', 'action' => 'view', $hotelPromotion->user->id]) : '' ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Name') ?></th>
									<td><?= h($hotelPromotion->hotel_name) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Location') ?></th>
									<td><?= h($hotelPromotion->hotel_location) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Category') ?></th>
									<td><?= $hotelPromotion->has('hotel_category') ? $this->Html->link($hotelPromotion->hotel_category->name, ['controller' => 'HotelCategories', 'action' => 'view', $hotelPromotion->hotel_category->id]) : '' ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Website') ?></th>
									<td><?= h($hotelPromotion->website) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Payment Status') ?></th>
									<td><?= h($hotelPromotion->payment_status) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Price Master') ?></th>
									<td><?= $hotelPromotion->has('price_master') ? $this->Html->link($hotelPromotion->price_master->week, ['controller' => 'PriceMasters', 'action' => 'view', $hotelPromotion->price_master->id]) : '' ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Id') ?></th>
									<td><?= $this->Number->format($hotelPromotion->id) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Cheap Tariff') ?></th>
									<td><?= $this->Number->format($hotelPromotion->cheap_tariff) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Expensive Tariff') ?></th>
									<td><?= $this->Number->format($hotelPromotion->expensive_tariff) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Pic') ?></th>
									<td><?= $this->Number->format($hotelPromotion->hotel_pic) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Total Charges') ?></th>
									<td><?= $this->Number->format($hotelPromotion->total_charges) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Hotel Rating') ?></th>
									<td><?= $this->Number->format($hotelPromotion->hotel_rating) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Visible Date') ?></th>
									<td><?= h($hotelPromotion->visible_date) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Created On') ?></th>
									<td><?= h($hotelPromotion->created_on) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Updated On') ?></th>
									<td><?= h($hotelPromotion->updated_on) ?></td>
								</tr>
								<tr>
									<th scope="row"><?= __('Accept Date') ?></th>
									<td><?= h($hotelPromotion->accept_date) ?></td>
								</tr>
							</table>
							