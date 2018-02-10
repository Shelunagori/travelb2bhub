<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Admin Role'), ['controller' => 'AdminRole', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin Role'), ['controller' => 'AdminRole', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Permission Role'), ['controller' => 'PermissionRole', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Permission Role'), ['controller' => 'PermissionRole', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Userdetails'), ['controller' => 'Userdetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Userdetail'), ['controller' => 'Userdetails', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roles view large-9 medium-8 columns content">
    <h3><?= h($role->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($role->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Label') ?></th>
            <td><?= h($role->label) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($role->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created At') ?></th>
            <td><?= h($role->created_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated At') ?></th>
            <td><?= h($role->updated_at) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Admin Role') ?></h4>
        <?php if (!empty($role->admin_role)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Admin Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($role->admin_role as $adminRole): ?>
            <tr>
                <td><?= h($adminRole->role_id) ?></td>
                <td><?= h($adminRole->admin_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AdminRole', 'action' => 'view', $adminRole->role_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AdminRole', 'action' => 'edit', $adminRole->role_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AdminRole', 'action' => 'delete', $adminRole->role_id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminRole->role_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Permission Role') ?></h4>
        <?php if (!empty($role->permission_role)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Permission Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($role->permission_role as $permissionRole): ?>
            <tr>
                <td><?= h($permissionRole->permission_id) ?></td>
                <td><?= h($permissionRole->role_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PermissionRole', 'action' => 'view', $permissionRole->permission_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PermissionRole', 'action' => 'edit', $permissionRole->permission_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PermissionRole', 'action' => 'delete', $permissionRole->permission_id], ['confirm' => __('Are you sure you want to delete # {0}?', $permissionRole->permission_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Userdetails') ?></h4>
        <?php if (!empty($role->userdetails)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('City Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Contact No') ?></th>
                <th scope="col"><?= __('Company Name') ?></th>
                <th scope="col"><?= __('Zipcode') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created At') ?></th>
                <th scope="col"><?= __('Updated At') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($role->userdetails as $userdetails): ?>
            <tr>
                <td><?= h($userdetails->id) ?></td>
                <td><?= h($userdetails->user_id) ?></td>
                <td><?= h($userdetails->image) ?></td>
                <td><?= h($userdetails->email) ?></td>
                <td><?= h($userdetails->state_id) ?></td>
                <td><?= h($userdetails->city_id) ?></td>
                <td><?= h($userdetails->country_id) ?></td>
                <td><?= h($userdetails->role_id) ?></td>
                <td><?= h($userdetails->address) ?></td>
                <td><?= h($userdetails->contact_no) ?></td>
                <td><?= h($userdetails->company_name) ?></td>
                <td><?= h($userdetails->zipcode) ?></td>
                <td><?= h($userdetails->status) ?></td>
                <td><?= h($userdetails->created_at) ?></td>
                <td><?= h($userdetails->updated_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Userdetails', 'action' => 'view', $userdetails->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Userdetails', 'action' => 'edit', $userdetails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Userdetails', 'action' => 'delete', $userdetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userdetails->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($role->users)): ?>
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
            <?php foreach ($role->users as $users): ?>
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
