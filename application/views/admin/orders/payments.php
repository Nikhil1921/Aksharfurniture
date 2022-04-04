<!DOCTYPE>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<title></title>
		<link rel='stylesheet' type='text/css' href='<?= base_url() ?>invoice/css/style.css' />
		<link rel='stylesheet' type='text/css' href='<?= base_url() ?>invoice/css/print.css' media="print" />
	</head>
	<body>
		<div class="card">
			<div class="card-block">
				<div id="page-wrap">
					<div id="identity">
						<!-- <div id="address">
								<p>GST NO : 24ANUPP1846N2Z7</p>
								<p>PAN CARD NO : ANUPP1846N</p>
						</div> -->
						<div class="logo-image">
							<img class="im" id="image" src="<?= base_url('assets/assets/images/logo.png') ?>" alt="logo" />
						</div>
						<!-- <div id="logo">
									
						</div> -->
						<div id="address1">
							<p class="mr-b-p">414, Lilamani Corporate Heights, opp. Ramdev Tekra BRTS, Nava Vadaj, Ahmedabad, Gujarat 380013
							</p>
						</div>
					</div>
					<div style="clear:both"></div>
					<p id="header">Payment History</p>
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
								<td># <?= $book['order_id'] ?></td>
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
							<th>Payment Type</th>
							<th>Payment ID</th>
							<th>Payment Date</th>
							<th>Payment</th>
						</tr>
						<?php $sub = 0; foreach (json_decode($book['payment_details']) as $k => $v): ?>
						<tr class="item-row">
							<td class="description"><?= ucfirst($v->pay_type) ?></td>
							<td> <?= $v->payment_id ?></td>
							<td> <?= $v->pay_at ?></td>
							<td> ₹ <?= $v->payment ?></td>
						</tr>
						<?php $sub += $v->payment; endforeach ?>
						<!-- <tr>
							<td colspan="4"  class="total-line">Subtotal</td>
							<td class="total-value"><div id="subtotal">₹ <?= $sub; ?></div></td>
						</tr> -->
						<!-- <tr>
							<td colspan="4"  class="total-line">SGST(9%)</td>
							<td class="total-value"><div id="total"><?= $book['price']; ?></div></td>
						</tr>
						<tr>
							<td colspan="4"  class="total-line">CGST(9%)</td>
							<td class="total-value"><?= $book['price']; ?></td>
						</tr> -->
						<tr>
							<td colspan="3" class="total-line grandtotal">Total Paid</td>
							<td class="total-value grandtotal"><div class="due"> ₹ <?= $sub ?></div></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2 offset-3">
					<button type="submit" class="btn btn-primary" id="print-invoice" onclick="jQuery('#page-wrap').print()">Print</button>
				</div>
				<div class="col-sm-2 offset-3">
					<a href="<?= base_url('admin/orders'); ?>" class="btn btn-danger">Cancel</a>
				</div>
			</div>
		</div>
	</body>
</html>