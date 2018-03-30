
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
<html>
<head>
    <?= $this->Html->charset() ?>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
        <title>Travel B2B Hub</title>
    
  
    <?=$this->Html->css([ 'front/css/bootstrap.min','front/css/style','front/css/inner-style','front/css/carouselTicker','front/css/responsive-slider-parallax' ]);?>
   
     <?php echo $this->Html->script(['front/js/jquery-2.2.3.min', 'front/js/bootstrap.min']);?>
 
</head>
<body class="hold-transition skin-blue sidebar-mini">
    
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        
    </footer>
</body>
</html>
