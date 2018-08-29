<h2><?php echo $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/create'); ?>
	<div class="form-group">
		<input type="text" name="name" class="form-control" placeholder="new category">
	</div>
	<button type="submit" class="btn btn-success">Submit</button>
</form>