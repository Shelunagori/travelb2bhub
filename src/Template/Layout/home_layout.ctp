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
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset+"UTF-8">
	<meta http-equiv="X-UA-compatible" Content="IE-edge"><!--for microsoft explore compatible-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Travelb2bhub</title>
    <?=$this->Html->css([ 'home/bootstrap','home/style', 'home/slider' ]);?>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <?php echo $this->Html->script(['home/bootstrap',]);?>

</head>
<body >
	<?php echo $this->element('header');?>
	<?= $this->fetch('content') ?>
	<?php echo $this->element('footer');?>
</body>
</html>
   
  

