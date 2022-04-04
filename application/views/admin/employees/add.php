<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">Add <?= ucwords($name) ?></h2>
		<form action="<?= base_url('admin/'.$name.'/add') ?>" method="POST" enctype="multipart/form-data" id="employeeForm">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="name">Name</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round" name="name" id="name" placeholder="Name" value="<?= set_value('name') ?>">
							<?=  form_error('name') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="mobile">Mobile</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round input-number" name="mobile" id="mobile" placeholder="Mobile" value="<?= set_value('mobile') ?>" maxlength="10">
							<?=  form_error('mobile') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="password">Password</label>
						</div>
						<div class="col-md-12">
							<input type="password" class="form-control form-control-round" name="password" id="password" placeholder="Password">
							<?=  form_error('password') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="c_password">Confirm Password</label>
						</div>
						<div class="col-md-12">
							<input type="password" class="form-control form-control-round" name="c_password" id="c_password" placeholder="Confirm Password">
							<?=  form_error('c_password') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="email">Email</label>
						</div>
						<div class="col-md-12">
							<input type="email" class="form-control form-control-round" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>">
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
							<textarea class="form-control form-control-round" name="address" id="address" placeholder="Address"><?= set_value('address') ?></textarea>
							<?=  form_error('address') ?>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2 offset-3">
					<button type="submit" class="btn btn-info btn-round waves-effect waves-light fa fa-check"></button>
				</div>
				<div class="col-md-2 offset-3">
					<a href="<?= base_url('admin/'.$name); ?>" class="btn btn-danger btn-round waves-effect waves-light fa fa-times"></a>
				</div>
			</div>
		</form>
	</div>
</div>