<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<div class="row card-block">
			<h4 class="sub form-control-info"><?= ucfirst($name) ?> List</h4>
			<div class="col-12 row">
				<div class="col-10"></div>
				<div class="col-2" align="right">
					<a href="<?= base_url('admin/'.$name.'/add'); ?>" class="btn btn-success btn-round waves-effect waves-light fa fa-plus"></a>
				</div>
			</div>
		</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover table-bordered nowrap" id="dataTable">
				<thead>
					<tr>
						<th class="target">Sr No.</th>
						<th>Name</th>
						<th>Mobile</th>
						<th>Email</th>
						<th class="target">Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<input type="hidden" id="url" value="<?= base_url('admin/'.$name.'/get')?>">
	</div>
</div>