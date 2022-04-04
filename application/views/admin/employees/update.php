<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">Update <?= ucwords($name) ?></h2>
		<form action="<?= base_url('admin/'.$name.'/update/').e_id($data['id']) ?>" method="POST" enctype="multipart/form-data" id="employeeForm">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<label class="col-form-label" for="name">Name</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round" name="name" id="name" placeholder="Name" value="<?= (!empty(set_value('name'))) ? set_value('name') : $data['name'] ?>">
							<?=  form_error('name') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<label class="col-form-label" for="mobile">Mobile</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round input-number" name="mobile" id="mobile" placeholder="Mobile" value="<?= (!empty(set_value('mobile'))) ? set_value('mobile') : $data['mobile'] ?>" maxlength="10">
							<?=  form_error('mobile') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<label class="col-form-label" for="email">Email</label>
						</div>
						<div class="col-md-12">
							<input type="email" class="form-control form-control-round" name="email" id="email" placeholder="Email" value="<?= (!empty(set_value('email'))) ? set_value('email') : $data['email'] ?>">
							<?=  form_error('email') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="address">Address</label>
						</div>
						<div class="col-md-12">
							<textarea class="form-control form-control-round" name="address" id="address" placeholder="Address"><?= (!empty(set_value('address'))) ? set_value('address') : $data['address'] ?></textarea>
							<?=  form_error('address') ?>
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