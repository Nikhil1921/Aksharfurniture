<!DOCTYPE>
<html>
	<head>
		<title>AKSHAR FARNITURE INVOICE</title>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/css/invoice.css') ?>">
	</head>
	<body>
		<div class="container" id="page-wrap">
			<div class="mwrap">
				<div class="t1">
					<span>|| JAI SWAMINARAYAN ||</span>
				</div>
				<div class="t2">
					<span class="mo">Mo. 9725633161</span>
				</div>
			</div>
			<h2 class="title">AKSHAR FARNITURE</h2>
			<span class="addre">Nr. Sayona City Under Pass, Nr Sopan saran, Opp Silver Star Gali, Chandlodiya,Ahmedabad-382481</span>
			<div class="mwrap fo-wra">
				<div class="form-left">
					<form class="form-inline f1">
						<div class="mwrap in-wra">
							<label for="email">Name</label>
							<span><?= ucwords($data['cust_name']) ?></span>
						</div>
						<div class="mwrap in-wra">
							<label for="pwd">Address</label>
							<span><?= ucwords($data['cust_address']) ?></span>
						</div>
						<div class="mwrap in-wra">
							<label for="pwd" class="phone">Mob.</label>
							<span>+91 <?= $data['cust_mobile'] ?></span>
						</div>
					</form>
				</div>
				<div class="form-right">
					<form class="form-inline f2">
						<div class="mwrap in-wra f2-wra">
							<label for="email">Order No: </label>
							<span># <?= $data['order_id'] ?></span>
						</div>
						<div class="mwrap in-wra f2-wra">
							<label for="pwd">Book Date:</label>
							<span><?= date('d-m-Y', strtotime($data['book_date'])) ?></span>
						</div>
						<div class="mwrap in-wra f2-wra last">
							<label for="pwd">Delivery Date:</label>
							<span><?= date('d-m-Y', strtotime($data['delivery_date'])) ?></span>
						</div>
					</form>
				</div>
			</div>
			<div class="mwrap fo-wra sales-wrap">
				<div class="form-left">
					<div class="mwrap  one">
						<label for="email">Sales Person:</label>
						<span><?= ucwords($data['name']) ?></span>
					</div>
				</div>
				<div class="mono-wra mob">
					<div class="mwrap  one">
						<label for="email" class="mm">Mob.</label>
						<span>+91 <?= $data['mobile'] ?></span>
					</div>
				</div>
			</div>
			<table id="customers">
				<tr>
					<th>Description</th>
					<th>No.</th>
					<th>Rate</th>
					<th>Total</th>
				</tr>
				<?php foreach ($data['details'] as $key => $v): ?>
				<tr>
					<td><?= ucwords($v['description']) ?></td>
					<td><?= $v['qty'] ?></td>
					<td><?= $v['rate'] ?></td>
					<td><?= $v['total'] ?></td>
				</tr>
				<?php endforeach ?>
				<tr>
					<td></td>
					<td></td>
					<td class="rt">Total</td>
					<td class="rt"><?= $data['total_bill'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td class="rt">Advance</td>
					<td class="rt"><?= $data['pay_bill'] ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td class="rt">Balance</td>
					<td class="rt"><?= $data['pending_bill'] ?></td>
				</tr>
			</table>
			<div class="mwrap for-wra">
				<div class="">
					<ul>
						<li>Subject to Ahmedabad Jurisdiction Only</li>
						<li>E.& o.E.</li>
						<li>Delivery will be Delivered Only After Payment </li>
					</ul>
				</div>
				<div class="infor">
					<span>For,</span><span class="inname">AKSHAR FARNITURE</span>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group row">
			<div class="col-sm-2 offset-3">
				<button type="submit" class="btn btn-primary" id="print-invoice" onclick="jQuery('#page-wrap').print()">Print</button>
			</div>
			<div class="col-sm-2 offset-3">
				<a href="<?= base_url('admin/orders'); ?>" class="btn btn-danger">Cancel</a>
			</div>
		</div>
	</body>
</html>