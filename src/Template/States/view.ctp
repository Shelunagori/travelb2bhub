<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit State'), ['action' => 'edit', $state->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete State'), ['action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id)]) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="states view large-9 medium-8 columns content">
    <h3><?= h($state->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('State Name') ?></th>
            <td><?= h($state->state_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($state->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($state->country_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($state->created_at) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($state->users)): ?>
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
            <?php foreach ($state->users as $users): ?>
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
