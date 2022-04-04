<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">Add <?= ucwords($name) ?></h2>
		<form action="<?= base_url('admin/'.$name.'/add') ?>" method="POST" enctype="multipart/form-data" id="productForm">
			<div class="row">
				<!-- <div class="col-md-6">
						<div class="form-group">
								<div class="col-md-4">
										<label class="col-form-label" for="c_name">Category Name</label>
								</div>
								<div class="col-md-12">
										<select class="form-control form-control-round" name="c_name" id="c_name" placeholder="Name" >
								<?php foreach ($cats as $k => $v): ?>
								<option value="<?= $v['id'] ?>" <?= set_select('c_name', $v['id'], false) ?>><?= ucwords($v['c_name']) ?></option>
								<?php endforeach ?>
							</select>
							<?=  form_error('c_name') ?>
						</div>
					</div>
				</div> -->
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="p_name">Product Name/Size</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round" name="p_name" id="p_name" placeholder="Product Name/Size" value="<?= set_value('p_name') ?>">
							<?=  form_error('p_name') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="price">Price</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round input-number" name="price" id="price" placeholder="Price" value="<?= set_value('price') ?>">
							<?=  form_error('price') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="include_gst">18% GST Included?</label>
						</div>
						<div class="col-md-12">
							<div class="col-sm-8 form-radio">
								<div class="radio radio-outline radio-inline">
									<label>
										<input type="radio" name="include_gst" value="1" <?= set_radio('include_gst', '1', TRUE) ?> />
										<i class="helper"></i>Yes
									</label>
								</div>
								<div class="radio radio-outline radio-inline">
									<label>
										<input type="radio" name="include_gst" value="0" <?= set_radio('include_gst', '0', TRUE) ?> />
										<i class="helper"></i>No
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="description">Description</label>
						</div>
						<div class="col-md-12">
							<textarea class="form-control form-control-round" name="description" id="description" placeholder="Description"><?= set_value('description') ?></textarea>
							<?=  form_error('description') ?>
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