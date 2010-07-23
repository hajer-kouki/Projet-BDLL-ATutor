<?php global $order, $search_string; 
if ($search_string!=''){
	$search_string = SEP.$search_string;
}
?>
<?php if(isset($_SESSION['member_id']) && $_SESSION['member_id'] >0): ?>
<div>
	<a href="<?php echo AT_JB_BASENAME.'subscribe.php'; ?>"><?php echo _AT('jb_subscribe'); ?></a>
</div>
<?php endif; ?>

<div>
	<table class="data static" summary="" rules="rows">
		<thead>
			<th><?php echo _AT('id'); ?></th>
			<th class="sort"><a href="<?php echo $_SERVER['PHP_SELF']."?col=title".SEP."order=$order".$search_string; ?>"><?php echo _AT('jb_title'); ?></a></th>
			<th><?php echo _AT('jb_employer'); ?></th>
			<th><?php echo _AT('categories'); ?></th>
			<th class="sort"><a href="<?php echo $_SERVER['PHP_SELF']."?col=created_date".SEP."order=$order".$search_string; ?>"><?php echo _AT('created_date'); ?></a></th>
			<th class="sort"><a href="<?php echo $_SERVER['PHP_SELF']."?col=closing_date".SEP.SEP."order=$order".$search_string; ?>"><?php echo _AT('jb_closing_date'); ?></a></th>
		</thead>

		<tbody>
			<?php 
				if (!empty($this->job_posts)):
					foreach ($this->job_posts as $row): 
						if (!empty($this->bookmark_posts) && in_array($row['id'], $this->bookmark_posts)){
							$bookmark_icon = '*';
						} else {
							$bookmark_icon = '';
						}
			?>
			<tr>
				<td><a href="<?php echo AT_JB_BASENAME.'view_post.php?jid='.$row['id'];?>" title="<?php echo _AT('jb_view_job_post'); ?>"><?php echo $bookmark_icon . $row['id']; ?></a></td>
				<td><a href="<?php echo AT_JB_BASENAME.'view_post.php?jid='.$row['id'];?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></td>
				<td><?php 
						$employer = new Employer($row['employer_id']);
						echo $employer->getName(); 
					?>
				</td>
				<td>
				<?php if(is_array($row['categories'])):
						foreach($row['categories'] as $category): 
				?>
				<span><?php echo $this->job_obj->getCategoryNameById($category);?></span> ; 
				<?php endforeach; else: ?>
				<span><?php echo $this->job_obj->getCategoryNameById($row['categories']);?></span>
				<?php endif; ?>
				</td>
				<td><?php echo AT_DATE(_AT("announcement_date_format"), $row['created_date']); ?></td>
				<td><?php echo AT_DATE(_AT("announcement_date_format"), $row['closing_date']); ?></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr><td colspan="6"><?php echo _AT('none_found');?></td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
