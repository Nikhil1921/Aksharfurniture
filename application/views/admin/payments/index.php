<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<div class="row card-block">
			<h4 class="sub form-control-info"><?= ucfirst($name) ?> List</h4>
		</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover table-bordered nowrap" id="dataTable">
				<thead>
					<tr>
						<th class="target">Sr No.</th>
						<th class="target">Order ID</th>
						<th>Employee</th>
						<th>Customer</th>
						<th class="target">Payment Type</th>
						<th class="target">Payment ID</th>
						<th class="target">Payment</th>
						<th class="target">Payment Date</th>
						<th class="target">Action</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<input type="hidden" id="url" value="<?= base_url('admin/payments/get')?>">
	</div>
</div>