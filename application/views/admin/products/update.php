<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">Update <?= ucwords($name) ?></h2>
		<form action="<?= base_url('admin/'.$name.'/update/').e_id($data['id']) ?>" method="POST" enctype="multipart/form-data" id="productForm">
			<div class="row">
				<!-- <div class="col-md-6">
					<div class="form-group">
						<div class="col-md-4">
							<label class="col-form-label" for="c_name">Category Name</label>
						</div>
						<div class="col-md-12">
							<select class="form-control form-control-round" name="c_name" id="c_name" placeholder="Name" >
								<?php foreach ($cats as $k => $v): ?>
									<option value="<?= $v['id'] ?>" <?= (!empty(set_value('c_name'))) ? set_select('c_name', $v['id'], false) : (($data['cat_id'] == $v['id']) ? 'selected' : '') ?>><?= ucwords($v['c_name']) ?></option>
								<?php endforeach ?>
							</select>
							<?=  form_error('c_name') ?>
						</div>
					</div>
				</div> -->
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<label class="col-form-label" for="p_name">Product Name/Size</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round" name="p_name" id="p_name" placeholder="Product Name/Size" value="<?= (!empty(set_value('p_name'))) ? set_value('p_name') : $data['p_name'] ?>">
							<?=  form_error('p_name') ?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<label class="col-form-label" for="price">Price</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control form-control-round input-number" name="price" id="price" placeholder="Price" value="<?= (!empty(set_value('price'))) ? set_value('price') : $data['price'] ?>" maxlength="10">
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
										<input type="radio" name="include_gst" value="1" <?= (!empty(set_value('include_gst'))) ? set_radio('include_gst', '1', TRUE) : (($data['include_gst'] == 1) ? 'checked' : '') ?> />
										<i class="helper"></i>Yes
									</label>
								</div>
								<div class="radio radio-outline radio-inline">
									<label>
										<input type="radio" name="include_gst" value="0" <?= (!empty(set_value('include_gst'))) ? set_radio('include_gst', '0', TRUE) : (($data['include_gst'] == 0) ? 'checked' : '') ?> />
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
							<textarea class="form-control form-control-round" name="description" id="description" placeholder="Description"><?= (!empty(set_value('description'))) ? set_value('description') : $data['description'] ?></textarea>
							<?=  form_error('description') ?>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-12">
					<div class="row">
						<?php foreach (explode(',', $data['images']) as $k => $v): ?>
						<div class="col-md-2" id="<?= $k ?>">
							<img src="<?= base_url('assets/images/products/').$v ?>" height="100" width="100" class="mr-2">
							<a href="<?= base_url('admin/'.$name.'/remove-image?id='.$data['id'].'&image='.$v) ?>" class="remove-image fa fa-trash" data-id="<?= $k ?>"></a>
						</div>
						<?php endforeach ?>
					</div>
				</div> -->
			</div>
			<br>
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