<!DOCTYPE>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title></title>
		<link rel='stylesheet' type='text/css' href='<?= base_url() ?>invoice/css/style.css' />
		<link rel='stylesheet' type='text/css' href='<?= base_url() ?>invoice/css/print.css' media="print" />
	</head>
	<body>
		<form action="" method="POST" accept-charset="utf-8">
			<div class="card">
				<div class="card-block">
					<div id="page-wrap">
						<div id="customer">
							<table id="meta" class="meta-width mr-r">
								<tr>
									<td class="meta-head">Customer Name</td>
									<td><?= ucwords($book['cust_name']) ?></td>
								</tr>
								<tr>
									<td class="meta-head">Customer Mobile No.</td>
									<td><?= $book['cust_mobile']; ?></td>
								</tr>
								<tr>
									<td class="meta-head">Sales Person Name</td>
									<td><?= ucwords($book['name']) ?></td>
								</tr>
								<tr>
									<td class="meta-head">Sales Person Mobile No.</td>
									<td><?= $book['mobile']; ?></td>
								</tr>
							</table>
							<table id="meta" class="meta-width">
								<tr>
									<td class="meta-head">Order ID</td>
									<td># <?= $book['order'] ?></td>
								</tr>
								<tr>
									<td class="meta-head">Date</td>
									<td><?= date("d-m-Y", strtotime($book['book_date'])); ?></td>
								</tr>
								<tr>
									<td class="meta-head">Total Payment</td>
									<td> ₹ <?= $book['total_bill'] ?></td>
								</tr>
								<tr>
									<td class="meta-head">Pending Payment</td>
									<td> ₹ <?= $book['pending_bill'] ?></td>
								</tr>
							</table>
						</div>
						<table id="items">
							<tr>
								<th>Description</th>
								<th>Quantity</th>
								<th>Rate</th>
							</tr>
							<?php foreach ($book['details'] as $key => $v): ?>
							<tr class="item-row">
								<td class="description"><?= ucwords($v['description']) ?><input type="hidden" name="description[]" value="<?= $v['description'] ?>"><input type="hidden" name="gst[]" value="<?= $v['gst_save'] ?>"></td>
								<td><input type="number" name="qty[]" value="<?= $v['qty'] ?>"></td>
								<td> ₹ <input type="text" name="rate[]" value="<?= $v['rate'] ?>"></td>
							</tr>
							<?php endforeach ?>
						</table>
						<table id="items">
							<tr>
								<th>Payment Type</th>
								<th>Payment ID</th>
								<th>Payment Date</th>
								<th>Payment</th>
							</tr>
							<?php foreach (json_decode($book['payment_details']) as $key => $v): ?>
							<tr class="item-row">
								<td class="description"><input type="hidden" name="pay_type[]" value="<?= $v->pay_type ?>"><?= $v->pay_type ?></td>
								<td class="description"><input type="hidden" name="payment_id[]" value="<?= $v->payment_id ?>"><?= $v->payment_id ?></td>
								<td class="description"><input type="hidden" name="pay_at[]" value="<?= $v->pay_at ?>"><?= $v->pay_at ?></td>
								<td class="description">₹ <input type="text" name="payment[]" value="<?= $v->payment ?>"></td>
							</tr>
							<?php endforeach ?>
						</table>
						<div class="col-md-12 mt-5">
							<img src="<?= base_url('assets/images/order_book/'.$book['order_book']) ?>" alt="">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2 offset-3">
						<button type="submit" class="btn btn-primary" id="print-invoice">Save</button>
					</div>
					<div class="col-sm-2 offset-3">
						<a href="<?= base_url('admin/orders'); ?>" class="btn btn-danger">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>