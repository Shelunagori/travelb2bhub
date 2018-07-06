<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php if($_SERVER['REQUEST_URI']=='/'){?>
<title>Travel B2B Hub</title>
<meta name="keywords" content="B2B Travel Portal, TBO, Online Travel Agency, Hotel Marketing" />
<meta name="description" content="TravelB2BHub serves as a B2B Travel Portal Marketplace that connects Travel Agents &amp; Operators, Hoteliers, and Event Planners for travel business online (TBO)." />
<?php } else if($_SERVER['REQUEST_URI']=='/promotions'){ ?>
<title>Promote your hotel: Travel B2B Hub</title>
<meta name="keywords" content="B2B Travel Portal, TBO, Online Travel Agency, Hotel Marketing" />
<meta name="description" content="It is like an online travel agency that allows B2B buying and selling of Hotel Rooms, Travel Packages, and Taxi/Bus services among agents present in different parts of India. Hoteliers can also use the vast network for Hotel Marketing." />
<?php } else if($_SERVER['REQUEST_URI']=='/memberships'){ ?>
<title>Membership Plans: Travel B2B Hub</title>
<meta name="keywords" content="B2B Travel Portal, TBO, Online Travel Agency, Hotel Marketing" />
<meta name="description" content="TravelB2BHub serves as a B2B Travel Portal Marketplace and a Hotel Marketing Platform that connects Travel Agents, Tour Operators, Hoteliers, and Event Planners for travel business online (TBO)." />
<?php } else if($_SERVER['REQUEST_URI']=='/aboutus'){ ?>
<title>About Us: Travel B2B Hub</title>
<meta name="keywords" content="B2B Travel Portal, TBO, Online Travel Agency, Hotel Marketing" />
<meta name="description" content="B2B Travel is like a large B2B online travel agency that allows real-time buying and selling of Hotel Rooms, Travel Packages, and Taxi/Bus services among agents present in different parts of India." />
<?php } else if($_SERVER['REQUEST_URI']=='/contactus'){ ?>
<title>Contact Us: Travel B2B Hub</title>
<meta name="keywords" content="B2B Travel Portal, TBO, Online Travel Agency, Hotel Marketing" />
<meta name="description" content="Travel B2B Hub is like an online travel agency that allows B2B buying and selling of Hotel Rooms, Travel Packages, and Taxi/Bus services among agents present in different parts of India." />
<?php } else if($_SERVER['REQUEST_URI']=='/faq'){ ?>
<title>Frequently asked questions (FAQ): Travel B2B Hub</title>
<meta name="keywords" content="B2B Travel Portal, TBO, Online Travel Agency, Hotel Marketing" />
<meta name="description" content="Travel B2B Hub Frequently asked questions. TravelB2BHub provide the  B2B Travel Portal Marketplace and a Hotel Marketing Platform that connects Travel Agents." />
<?php } else {?>
<title>Travel B2B Hub</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php } ?>


<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Facebook and Twitter integration -->
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:url" content=""/>
<meta property="og:site_name" content=""/>
<meta property="og:description" content=""/>
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="shortcut icon" href="favicon.ico">


	
    <?=$this->Html->css([ 'bootstrap','bootstrap-datepicker.min'	 ]);?>
  <?php echo $this->Html->script(['jquery-1.9.1.min','bootstrap.min','bootstrap-datepicker.min']);?>
  <?=$this->Html->css(['home/style' ]);?>
  <?=$this->Html->css(['font-awesome-4.7.0/css/font-awesome.min' ]);?>
<script>

$('#adds').click(function add() {
    var $rooms = $("#noOfRoom");
    var a = $rooms.val();
    
    a++;
    $("#subs").prop("disabled", !a);
    $rooms.val(a);
});
$("#subs").prop("disabled", !$("#noOfRoom").val());

$('#subs').click(function subst() {
    var $rooms = $("#noOfRoom");
    var b = $rooms.val();
    if (b >= 1) {
        b--;
        $rooms.val(b);
    }
    else {
        $("#subs").prop("disabled", true);
    }
});

</script>
<script>
$('#add').click(function add() {
    var $rooms = $("#noOfRoo");
    var a = $rooms.val();
    
    a++;
    $("#sub").prop("disabled", !a);
    $rooms.val(a);
});
$("#sub").prop("disabled", !$("#noOfRoo").val());

$('#sub').click(function subst() {
    var $rooms = $("#noOfRoo");
    var b = $rooms.val();
    if (b >= 1) {
        b--;
        $rooms.val(b);
    }
    else {
        $("#sub").prop("disabled", true);
    }
});

</script>  
   
</head>

    

    <?php echo $this->element('header_new');?>
    <?= $this->fetch('content') ?>
    <?php echo $this->element('footer_new');?>
   
  

