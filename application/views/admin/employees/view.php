<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">View <?= ucwords($name) ?></h2>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-form-label">Name</label>
					</div>
					<div class="col-md-12">
						<input type="text" class="form-control form-control-round" value="<?= $data['name'] ?>" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-form-label">Mobile</label>
					</div>
					<div class="col-md-12">
						<input type="text" class="form-control form-control-round" value="<?= $data['mobile'] ?>" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-form-label">Email</label>
					</div>
					<div class="col-md-12">
						<input type="text" class="form-control form-control-round" value="<?= $data['email'] ?>" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-form-label">Address</label>
					</div>
					<div class="col-md-12">
						<textarea class="form-control form-control-round" disabled><?= $data['address'] ?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-2 offset-3">
				<a href="<?= base_url('admin/'.$name); ?>" class="btn btn-info btn-round waves-effect waves-light fa fa-check"></a>
			</div>
			<div class="col-sm-2 offset-3">
				<a href="<?= base_url('admin/'.$name); ?>" class="btn btn-danger btn-round waves-effect waves-light fa fa-times"></a>
			</div>
		</div>
	</div>
</div>