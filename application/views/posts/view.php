<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?></small><br>
<div class="post-body">
	<img class="post-photo" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
	<?php echo $post['body'] ?>
</div>
<?php if($this->session->userdata('user_id') == $post['user_id']): ?>
	<hr>
	<a class="btn btn-warning pull-left" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>" style="margin-right: 10px;" >edit</a>
	<?php echo form_open('/posts/delete/'.$post['id']); ?>
		<input type="submit" name="" value="delete" class="btn btn-danger">
	<?php echo form_close(); ?>
<?php endif; ?>


<hr>
<h3>Comments</h3>
<?php if($comments) : ?>
	<?php foreach($comments as $comment) : ?>
		<div class="well">
			<h5><?php echo $comment['body']; ?>  [by <strong><?php echo $comment['name']; ?></strong>]</h5>
		</div>
	<?php endforeach; ?>
<?php else : ?>
<?php endif; ?>
<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$post['id']); ?>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Comments</label>
		<textarea type="text" name="body" class="form-control"></textarea>
	</div>

	<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">

	<button class="btn btn-success" type="submit">Submit</button>
</form>
