<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">View <?= ucwords($name) ?></h2>
		<div class="row">
			<!-- <div class="col-md-6">
					<div class="form-group">
							<div class="col-md-12">
									<label class="col-form-label">Category Name</label>
							</div>
							<div class="col-md-12">
						<input type="text" class="form-control form-control-round" value="<?= $data['c_name'] ?>" disabled>
					</div>
				</div>
			</div> -->
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-form-label">Product Name/Size</label>
					</div>
					<div class="col-md-12">
						<input type="text" class="form-control form-control-round" value="<?= $data['p_name'] ?>" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-form-label">Price</label>
					</div>
					<div class="col-md-12">
						<input type="text" class="form-control form-control-round" value="<?= $data['price'] ?>" disabled>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-4">
						<label class="col-form-label">18% GST Included?</label>
					</div>
					<div class="col-md-12">
						<div class="col-sm-8 form-radio">
							<div class="radio radio-outline radio-inline">
								<label>
									<input type="radio" <?= ($data['include_gst'] == 1) ? 'checked' : '' ?> />
									<i class="helper"></i>Yes
								</label>
							</div>
							<div class="radio radio-outline radio-inline">
								<label>
									<input type="radio" <?= ($data['include_gst'] == 0) ? 'checked' : '' ?> />
									<i class="helper"></i>No
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-12">
						<label class="col-form-label">Description</label>
					</div>
					<div class="col-md-12">
						<textarea class="form-control form-control-round" disabled><?= $data['description'] ?></textarea>
					</div>
				</div>
			</div>
			<!-- <div class="col-md-12">
					<div class="row">
					<?php foreach (explode(',', $data['images']) as $k => $v): ?>
					<div class="col-md-2">
						<img src="<?= base_url('assets/images/products/').$v ?>" height="100" width="100">
					</div>
					<?php endforeach ?>
				</div>
			</div> -->
		</div>
		<!-- <br> -->
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