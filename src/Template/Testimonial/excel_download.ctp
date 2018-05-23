<?php
$file_name='Ratings';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$file_name.xls");
header("Content-Type: application/force-download");
header("Cache-Control: post-check=0, pre-check=0", true);
?>	
<table border="1">
	<thead>
		<tr style="background-color:#DFD9C4;">
			<th scope="col"><?= __('Sr.No') ?></th>
			<th scope="col"><?= __('User ID') ?></th>
			<th scope="col"><?= __('Username') ?></th>
			<th scope="col"><?= __('Reviewer') ?></th>
			<th scope="col" style="text-align:center"><?= __('Review/Rating') ?></th> 
			<th scope="col"><?= __('Comment') ?></th>  
		</tr>
	</thead>
	<tbody>
		<?php $i=1; foreach ($testimonial as $testimonials): ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?= $testimonials->user_id; ?></td>
			<td><?= $testimonials->user->first_name.' '.$testimonials->user->last_name ?></td>
			<td><?= $testimonials->author->first_name ?></td> 
			<td style="text-align:center"><?php $rate=$testimonials->rating;
				for($xxs=1;$xxs<=$rate;$xxs++)
				{
						echo " &#9733; ";
				}
			?>
			</td> 
			<td><?php echo $testimonials->comment; ?></td> 
		 
		</tr>
		<?php $i++; endforeach; ?>
	</tbody>
</table>