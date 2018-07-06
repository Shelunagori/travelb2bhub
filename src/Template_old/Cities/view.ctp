<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit City'), ['action' => 'edit', $city->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete City'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requests'), ['controller' => 'Requests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request'), ['controller' => 'Requests', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hotels'), ['controller' => 'Hotels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hotel'), ['controller' => 'Hotels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transports'), ['controller' => 'Transports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transport'), ['controller' => 'Transports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cities view large-9 medium-8 columns content">
    <h3><?= h($city->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($city->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $city->has('state') ? $this->Html->link($city->state->id, ['controller' => 'States', 'action' => 'view', $city->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($city->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($city->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($city->updated_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($city->created_at) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Category') ?></h4>
        <?= $this->Text->autoParagraph(h($city->category)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Requests') ?></h4>
        <?php if (!empty($city->requests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Final Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Locality') ?></th>
                <th scope="col"><?= __('Reference Id') ?></th>
                <th scope="col"><?= __('Response Id') ?></th>
                <th scope="col"><?= __('Total Budget') ?></th>
                <th scope="col"><?= __('Children') ?></th>
                <th scope="col"><?= __('Adult') ?></th>
                <th scope="col"><?= __('Room1') ?></th>
                <th scope="col"><?= __('Room2') ?></th>
                <th scope="col"><?= __('Room3') ?></th>
                <th scope="col"><?= __('Child With Bed') ?></th>
                <th scope="col"><?= __('Child Without Bed') ?></th>
                <th scope="col"><?= __('Hotel Rating') ?></th>
                <th scope="col"><?= __('Hotel Category') ?></th>
                <th scope="col"><?= __('Meal Plan') ?></th>
                <th scope="col"><?= __('Destination City') ?></th>
                <th scope="col"><?= __('Check In') ?></th>
                <th scope="col"><?= __('Check Out') ?></th>
                <th scope="col"><?= __('Transport Requirement') ?></th>
                <th scope="col"><?= __('Pickup City') ?></th>
                <th scope="col"><?= __('Pickup State') ?></th>
                <th scope="col"><?= __('Pickup Country') ?></th>
                <th scope="col"><?= __('Pickup Locality') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Final Locality') ?></th>
                <th scope="col"><?= __('Final City') ?></th>
                <th scope="col"><?= __('Final State') ?></th>
                <th scope="col"><?= __('Final Country') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Stops') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Accept Date') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->requests as $requests): ?>
            <tr>
                <td><?= h($requests->id) ?></td>
                <td><?= h($requests->category_id) ?></td>
                <td><?= h($requests->user_id) ?></td>
                <td><?= h($requests->final_id) ?></td>
                <td><?= h($requests->state_id) ?></td>
                <td><?= h($requests->country_id) ?></td>
                <td><?= h($requests->locality) ?></td>
                <td><?= h($requests->reference_id) ?></td>
                <td><?= h($requests->response_id) ?></td>
                <td><?= h($requests->total_budget) ?></td>
                <td><?= h($requests->children) ?></td>
                <td><?= h($requests->adult) ?></td>
                <td><?= h($requests->room1) ?></td>
                <td><?= h($requests->room2) ?></td>
                <td><?= h($requests->room3) ?></td>
                <td><?= h($requests->child_with_bed) ?></td>
                <td><?= h($requests->child_without_bed) ?></td>
                <td><?= h($requests->hotel_rating) ?></td>
                <td><?= h($requests->hotel_category) ?></td>
                <td><?= h($requests->meal_plan) ?></td>
                <td><?= h($requests->destination_city) ?></td>
                <td><?= h($requests->check_in) ?></td>
                <td><?= h($requests->check_out) ?></td>
                <td><?= h($requests->transport_requirement) ?></td>
                <td><?= h($requests->pickup_city) ?></td>
                <td><?= h($requests->pickup_state) ?></td>
                <td><?= h($requests->pickup_country) ?></td>
                <td><?= h($requests->pickup_locality) ?></td>
                <td><?= h($requests->city_id) ?></td>
                <td><?= h($requests->final_locality) ?></td>
                <td><?= h($requests->final_city) ?></td>
                <td><?= h($requests->final_state) ?></td>
                <td><?= h($requests->final_country) ?></td>
                <td><?= h($requests->comment) ?></td>
                <td><?= h($requests->start_date) ?></td>
                <td><?= h($requests->end_date) ?></td>
                <td><?= h($requests->stops) ?></td>
                <td><?= h($requests->status) ?></td>
                <td><?= h($requests->is_deleted) ?></td>
                <td><?= h($requests->accept_date) ?></td>
                <td><?= h($requests->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Requests', 'action' => 'view', $requests->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $requests->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Requests', 'action' => 'delete', $requests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requests->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hotels') ?></h4>
        <?php if (!empty($city->hotels)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Req Id') ?></th>
                <th scope="col"><?= __('Room1') ?></th>
                <th scope="col"><?= __('Room2') ?></th>
                <th scope="col"><?= __('Room3') ?></th>
                <th scope="col"><?= __('Child With Bed') ?></th>
                <th scope="col"><?= __('Child Without Bed') ?></th>
                <th scope="col"><?= __('Hotel Rating') ?></th>
                <th scope="col"><?= __('Hotel Category') ?></th>
                <th scope="col"><?= __('Meal Plan') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Locality') ?></th>
                <th scope="col"><?= __('Check In') ?></th>
                <th scope="col"><?= __('Check Out') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->hotels as $hotels): ?>
            <tr>
                <td><?= h($hotels->id) ?></td>
                <td><?= h($hotels->user_id) ?></td>
                <td><?= h($hotels->req_id) ?></td>
                <td><?= h($hotels->room1) ?></td>
                <td><?= h($hotels->room2) ?></td>
                <td><?= h($hotels->room3) ?></td>
                <td><?= h($hotels->child_with_bed) ?></td>
                <td><?= h($hotels->child_without_bed) ?></td>
                <td><?= h($hotels->hotel_rating) ?></td>
                <td><?= h($hotels->hotel_category) ?></td>
                <td><?= h($hotels->meal_plan) ?></td>
                <td><?= h($hotels->city_id) ?></td>
                <td><?= h($hotels->state_id) ?></td>
                <td><?= h($hotels->country_id) ?></td>
                <td><?= h($hotels->locality) ?></td>
                <td><?= h($hotels->check_in) ?></td>
                <td><?= h($hotels->check_out) ?></td>
                <td><?= h($hotels->created) ?></td>
                <td><?= h($hotels->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Hotels', 'action' => 'view', $hotels->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Hotels', 'action' => 'edit', $hotels->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Hotels', 'action' => 'delete', $hotels->id], ['confirm' => __('Are you sure you want to delete # {0}?', $hotels->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Transports') ?></h4>
        <?php if (!empty($city->transports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Transport Requirement') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Stops') ?></th>
                <th scope="col"><?= __('Comment Box') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->transports as $transports): ?>
            <tr>
                <td><?= h($transports->id) ?></td>
                <td><?= h($transports->user_id) ?></td>
                <td><?= h($transports->transport_requirement) ?></td>
                <td><?= h($transports->city_id) ?></td>
                <td><?= h($transports->stops) ?></td>
                <td><?= h($transports->comment_box) ?></td>
                <td><?= h($transports->created_at) ?></td>
                <td><?= h($transports->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Transports', 'action' => 'view', $transports->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Transports', 'action' => 'edit', $transports->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Transports', 'action' => 'delete', $transports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transports->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($city->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Mobile Number') ?></th>
                <th scope="col"><?= __('P Contact') ?></th>
                <th scope="col"><?= __('Fax') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Company Name') ?></th>
                <th scope="col"><?= __('Comp Image1') ?></th>
                <th scope="col"><?= __('Comp Image2') ?></th>
                <th scope="col"><?= __('Id Card') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Create At') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Adress1') ?></th>
                <th scope="col"><?= __('Locality') ?></th>
                <th scope="col"><?= __('Pincode') ?></th>
                <th scope="col"><?= __('Preference') ?></th>
                <th scope="col"><?= __('Email Verified') ?></th>
                <th scope="col"><?= __('Profile Pic') ?></th>
                <th scope="col"><?= __('Pancard Pic') ?></th>
                <th scope="col"><?= __('Company Img 1 Pic') ?></th>
                <th scope="col"><?= __('Company Img 2 Pic') ?></th>
                <th scope="col"><?= __('Id Card Pic') ?></th>
                <th scope="col"><?= __('Company Shop Registration Pic') ?></th>
                <th scope="col"><?= __('Travel Certificates') ?></th>
                <th scope="col"><?= __('Hotel Rating') ?></th>
                <th scope="col"><?= __('Hotel Name') ?></th>
                <th scope="col"><?= __('Hotel Categories') ?></th>
                <th scope="col"><?= __('Web Url') ?></th>
                <th scope="col"><?= __('Iata Pic') ?></th>
                <th scope="col"><?= __('Tafi Pic') ?></th>
                <th scope="col"><?= __('Taai Pic') ?></th>
                <th scope="col"><?= __('Iato Pic') ?></th>
                <th scope="col"><?= __('Adyoi Pic') ?></th>
                <th scope="col"><?= __('Iso9001 Pic') ?></th>
                <th scope="col"><?= __('Uftaa Pic') ?></th>
                <th scope="col"><?= __('Adtoi Pic') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col"><?= __('Last Login') ?></th>
                <th scope="col"><?= __('Activation') ?></th>
                <th scope="col"><?= __('Device Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($city->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->mobile_number) ?></td>
                <td><?= h($users->p_contact) ?></td>
                <td><?= h($users->fax) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->status) ?></td>
                <td><?= h($users->company_name) ?></td>
                <td><?= h($users->comp_image1) ?></td>
                <td><?= h($users->comp_image2) ?></td>
                <td><?= h($users->id_card) ?></td>
                <td><?= h($users->address) ?></td>
                <td><?= h($users->image) ?></td>
                <td><?= h($users->country_id) ?></td>
                <td><?= h($users->city_id) ?></td>
                <td><?= h($users->state_id) ?></td>
                <td><?= h($users->role_id) ?></td>
                <td><?= h($users->create_at) ?></td>
                <td><?= h($users->description) ?></td>
                <td><?= h($users->adress1) ?></td>
                <td><?= h($users->locality) ?></td>
                <td><?= h($users->pincode) ?></td>
                <td><?= h($users->preference) ?></td>
                <td><?= h($users->email_verified) ?></td>
                <td><?= h($users->profile_pic) ?></td>
                <td><?= h($users->pancard_pic) ?></td>
                <td><?= h($users->company_img_1_pic) ?></td>
                <td><?= h($users->company_img_2_pic) ?></td>
                <td><?= h($users->id_card_pic) ?></td>
                <td><?= h($users->company_shop_registration_pic) ?></td>
                <td><?= h($users->travel_certificates) ?></td>
                <td><?= h($users->hotel_rating) ?></td>
                <td><?= h($users->hotel_name) ?></td>
                <td><?= h($users->hotel_categories) ?></td>
                <td><?= h($users->web_url) ?></td>
                <td><?= h($users->iata_pic) ?></td>
                <td><?= h($users->tafi_pic) ?></td>
                <td><?= h($users->taai_pic) ?></td>
                <td><?= h($users->iato_pic) ?></td>
                <td><?= h($users->adyoi_pic) ?></td>
                <td><?= h($users->iso9001_pic) ?></td>
                <td><?= h($users->uftaa_pic) ?></td>
                <td><?= h($users->adtoi_pic) ?></td>
                <td><?= h($users->updated_at) ?></td>
                <td><?= h($users->last_login) ?></td>
                <td><?= h($users->activation) ?></td>
                <td><?= h($users->device_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
