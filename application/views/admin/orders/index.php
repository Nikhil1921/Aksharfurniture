<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="card-block">
		<div class="row card-block">
			<div class="col-md-3">
				<h4 class="sub form-control-info"><?= ucfirst($name) ?> List</h4>
			</div>
			<div class="col-md-2">
				<select class="form-control" id="employee" >
					<option value="0">All Employees</option>
					<?php foreach ($employees as $key => $v): ?>
					<option value="<?= $v['id'] ?>"><?= ucwords($v['name']) ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="col-md-3">
				<input type="date" id="s-date" class="form-control form-control-round" />
			</div>
			<div class="col-md-3">
				<input type="date" id="e-date" class="form-control form-control-round" />
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-primary" id="date-filter">Filter</button>
			</div>
		</div>
		<div class="table table-responsive">
			<table class="table table-striped table-hover table-bordered nowrap" id="dataTable">
				<thead>
					<tr>
						<th class="target">Sr No.</th>
						<th>Order ID</th>
						<th>Order Date</th>
						<th>Employee</th>
						<th>Customer</th>
						<th>Mobile</th>
						<th>Total</th>
						<th>Paid</th>
						<th>Pending</th>
						<th>Status</th>
						<th class="target">Payment Type</th>
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
<div id="payment" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Credit Payment For Order</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="<?= base_url('admin/orders/credit') ?>" method="post" accept-charset="utf-8" id="myForm">
				<div class="modal-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-12">
										<label class="col-form-label" for="order_id">Order ID</label>
									</div>
									<div class="col-md-12">
										<input type="text" class="form-control form-control-round" name="order_id" id="order_id" readonly="" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-12">
										<label class="col-form-label" for="pay_type">Payment Type</label>
									</div>
									<div class="col-md-12">
										<select class="form-control form-control-round" name="pay_type" id="pay_type" placeholder="Payment Type" >
											<option value="cash">Cash</option>
											<option value="online">Online</option>
											<option value="cheque">Cheque</option>
										</select>
										
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-12">
										<label class="col-form-label" for="pay_bill">Payment Amount</label>
									</div>
									<div class="col-md-12">
										<input type="text" class="form-control form-control-round" name="pay_bill" id="pay_bill" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-md-12">
										<label class="col-form-label" for="payment_id">Payment ID</label>
									</div>
									<div class="col-md-12">
										<input type="text" class="form-control form-control-round" name="payment_id" id="payment_id" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn waves-effect waves-dark btn-primary btn-outline-primary">Credit</button>
					<button type="button" class="btn waves-effect waves-dark btn-danger btn-outline-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>