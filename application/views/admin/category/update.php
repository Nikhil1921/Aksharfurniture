<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">Update <?= ucwords($name) ?></h2>
		<form action="<?= base_url('admin/'.$name.'/update/').e_id($data['id']) ?>" method="POST" enctype="multipart/form-data" id="productForm">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<label class="col-form-label" for="c_name">Name</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round" name="c_name" id="c_name" placeholder="Name" value="<?= (!empty(set_value('c_name'))) ? set_value('c_name') : $data['c_name'] ?>">
							<?=  form_error('c_name') ?>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2 offset-3">
					<button type="submit" class="btn btn-info btn-round waves-effect waves-light fa fa-check"></button>
				</div>
				<div class="col-sm-2 offset-3">
					<a href="<?= base_url('admin/'.$name); ?>" class="btn btn-danger btn-round waves-effect waves-light fa fa-times"></a>
				</div>
			</div>
		</form>
	</div>
</div>