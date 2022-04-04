<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-wrapper">
	<div class="page-body">
		<div class="row">
			<div class="col-md-12 col-xl-3">
				<div class="card comp-card">
					<div class="card-body">
						<a href="<?= base_url('admin/employees') ?>" title="Employees">
							<div class="row align-items-center">
								<div class="col">
									<h6 class="m-b-25 dash-green">Employees</h6>
									<h3 class="f-w-700 dash-green"><?= $this->main->count('employee',['is_delete' => 0]) ?></h3>
								</div>
								<div class="col-auto">
									<i class="fa fa-users dash-green-icon"></i>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-xl-3">
				<div class="card comp-card">
					<div class="card-body">
						<a href="<?= base_url('admin/products') ?>" title="Products">
							<div class="row align-items-center">
								<div class="col">
									<h6 class="m-b-25 dash-info">Products</h6>
									<h3 class="f-w-700 dash-info"><?= $this->main->count('products',['is_delete' => 0]) ?></h3>
								</div>
								<div class="col-auto">
									<i class="fa fa-file-text-o dash-info-icon"></i>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-xl-3">
				<div class="card comp-card">
					<div class="card-body">
						<a href="<?= base_url('admin/orders') ?>" title="Orders">
							<div class="row align-items-center">
								<div class="col">
									<h6 class="m-b-25 dash-info">Orders</h6>
									<h3 class="f-w-700 dash-info"><?= $this->main->count('orders',['is_delete' => 0]) ?></h3>
								</div>
								<div class="col-auto">
									<i class="fa fa-file-text-o dash-info-icon"></i>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>