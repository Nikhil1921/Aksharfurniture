<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<h2 class="sub-title form-control-info">Upload Images</h2>
		<form action="<?= base_url('admin/'.$name.'/images?prod_id='.$this->session->userdata('prod_id')) ?>" class="dropzone">
			<div class="fallback">
				<input name="image" type="file" multiple />
			</div>
		</form>
		<br>
		<div class="col-md-12">
			<a href="<?= base_url('admin/'.$name); ?>" class="btn btn-info btn-round waves-effect waves-light fa fa-check"></a>
		</div>
	</div>
</div>