<?php $__env->startSection('content'); ?>
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title"><?php echo e(__('backend/bitcoin.title')); ?></h3>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<?php if($isConnected): ?>
									<div class="row">
										<div class="col-lg-6 col-xl-4 order-lg-2 order-xl-1">
											<div class="k-portlet k-widget-12">
												<div class="k-portlet__body">
													<div class="k-widget-12__body">
														<div class="k-widget-12__head">
															<div class="k-widget-12__date k-widget-12__date--warning">
																<i class="fab fa-bitcoin" style="font-size: 24px;"></i>
															</div>
															<div class="k-widget-12__label">
																<h3 class="k-widget-12__title"><?php echo e(__('backend/bitcoin.balance')); ?></h3>
																<span class="k-widget-12__desc">
																	<?php echo e(App\Classes\BitcoinAPI::getFormattedServerBalance()); ?>

																	<?php echo e(App\Classes\BitcoinAPI::getFormattedServerBalanceCurrency(App\Models\Setting::getShopCurrency())); ?>

																</span>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/bitcoin.primarywallet.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<p>
														<?php echo __('backend/bitcoin.primarywallet.info'); ?>

													</p>

													<form method="POST" action="<?php echo e(route('backend-bitcoin-primarywallet-form')); ?>">
														<?php echo csrf_field(); ?>
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_primarywallet_address"><?php echo e(__('backend/bitcoin.primarywallet.walletaddress')); ?></label>
															<input type="text" class="form-control <?php if($errors->has('bitcoin_primarywallet_address')): ?> is-invalid <?php endif; ?>" name="bitcoin_primarywallet_address" id="bitcoin_primarywallet_address" placeholder="<?php echo e(__('backend/bitcoin.primarywallet.walletaddress')); ?>" value="<?php echo e(strlen(App\Models\Setting::get('bitcoin.primarywallet')) > 0 ? decrypt(App\Models\Setting::get('bitcoin.primarywallet')) : ''); ?>" />

															<?php if($errors->has('bitcoin_primarywallet_address')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('bitcoin_primarywallet_address')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="<?php echo e(__('backend/bitcoin.primarywallet.submit_button')); ?>" />
														</div>
													</form>
												</div>
											</div>

											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/bitcoin.generateaddress.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<div class="form-group" style="width: 100%;">
														<input type="text" onClick="$(this).select()" class="form-control text-center" value="<?php echo e(App\Classes\BitcoinAPI::getBitcoinClient()->getnewaddress(Auth::user()->username, 'p2sh-segwit')); ?>" readonly />
													</div>

													<div class="form-group">
														<a href="<?php echo e(route('backend-bitcoin-dashboard')); ?>" class="btn btn-wide btn-bold btn-danger"><?php echo e(__('backend/bitcoin.generateaddress.regenerate')); ?></a>
													</div>
												</div>
											</div>

											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/bitcoin.sendbtc.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<form method="POST" action="<?php echo e(route('backend-bitcoin-sendbtc-form')); ?>">
														<?php echo csrf_field(); ?>
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_sendbtc_address"><?php echo e(__('backend/bitcoin.sendbtc.walletaddress')); ?></label>
															<input type="text" class="form-control <?php if($errors->has('bitcoin_sendbtc_address')): ?> is-invalid <?php endif; ?>" name="bitcoin_sendbtc_address" id="bitcoin_sendbtc_address" placeholder="<?php echo e(__('backend/bitcoin.sendbtc.walletaddress')); ?>" value="<?php echo e(old('bitcoin_sendbtc_address')); ?>" />

															<?php if($errors->has('bitcoin_sendbtc_address')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('bitcoin_sendbtc_address')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_sendbtc_amount"><?php echo e(__('backend/bitcoin.sendbtc.amount')); ?></label>
															<input type="text" class="form-control <?php if($errors->has('bitcoin_sendbtc_amount')): ?> is-invalid <?php endif; ?>" name="bitcoin_sendbtc_amount" id="bitcoin_sendbtc_amount" placeholder="<?php echo e(__('backend/bitcoin.sendbtc.amount')); ?>" value="<?php echo e(old('bitcoin_sendbtc_amount')); ?>" />

															<?php if($errors->has('bitcoin_sendbtc_amount')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('bitcoin_sendbtc_amount')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_sendbtc_fee"><?php echo e(__('backend/bitcoin.sendbtc.fee')); ?></label>
															<input type="text" class="form-control <?php if($errors->has('bitcoin_sendbtc_fee')): ?> is-invalid <?php endif; ?>" name="bitcoin_sendbtc_fee" id="bitcoin_sendbtc_fee" placeholder="<?php echo e(__('backend/bitcoin.sendbtc.fee')); ?>" value="<?php echo e(App\Classes\BitcoinAPI::getRecommendedFee()['btc']); ?>" />
															<small>
																<?php echo __('backend/bitcoin.sendbtc.fee_info', [
																	'btc' => App\Classes\BitcoinAPI::getRecommendedFee()['btc'],
																	'satoshi' => App\Classes\BitcoinAPI::getRecommendedFee()['satoshi']
																]); ?>

															</small>
															
															<?php if($errors->has('bitcoin_sendbtc_fee')): ?>
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong><?php echo e($errors->first('bitcoin_sendbtc_fee')); ?></strong>
																</span>
															<?php endif; ?>
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="<?php echo e(__('backend/bitcoin.sendbtc.submit_button')); ?>" />
														</div>
													</form>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1">
											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title"><?php echo e(__('backend/bitcoin.transactions.title')); ?></h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<?php if(count($transactions)): ?>
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th scope="col"><?php echo e(__('backend/bitcoin.transactions.wallet')); ?></th>
																	<th scope="col"><?php echo e(__('backend/bitcoin.transactions.txid')); ?></th>
																	<th scope="col"><?php echo e(__('backend/bitcoin.transactions.amount')); ?></th>
																	<th scope="col"><?php echo e(__('backend/bitcoin.transactions.status')); ?></th>
																	<th scope="col"><?php echo e(__('backend/bitcoin.transactions.date')); ?></th>
																</tr>
															</thead>
															<tbody>
																<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<tr>
																	<td><?php echo e($transaction['address']); ?></td>
																	<td style="max-width:200px;word-break:break-all;">
																		<?php if(strlen($transaction['txid']) > 0): ?>
																			<div>
																				<a href="https://blockchain.info/tx/<?php echo e($transaction['txid']); ?>" target="_blockchain_<?php echo e($loop->iteration); ?>">
																					<?php echo e($transaction['txid']); ?>

																					<ion-icon name="open"></ion-icon>
																				</a>
																			</div>
																		<?php endif; ?>
																	</td>
																	<td class="<?php if($transaction['category'] == 'receive'): ?> text-success <?php else: ?> text-danger <?php endif; ?>">
																		<?php echo e($transaction['amount']); ?> BTC
																	</td>
																	<td class="">
																		<?php if($transaction['confirmations'] > 0): ?>
																			<?php echo e(__('backend/bitcoin.transactions.confirmed')); ?>

																		<?php else: ?>
																			<?php echo e(__('backend/bitcoin.transactions.confirmations', [
																				'confirms' => $transaction['confirmations'],
																				'confirms_needed' => App\Models\Setting::get('shop.btc_confirms_needed')
																			])); ?>

																		<?php endif; ?>
																	</td>
																	<td>
																		<?php echo e(date('d.m.Y H:i', $transaction['time'])); ?>

																	</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															</tbody>
														</table>
													<?php else: ?>
														<i><?php echo e(__('backend/bitcoin.transactions.no_entries')); ?></i>
													<?php endif; ?>

													<?php echo preg_replace('/' . $transactions->currentPage() . '\?page=/', '', $transactions->links()); ?>

												</div>
											</div>
										</div>
									</div>
									<?php else: ?>
										<div class="alert alert-danger">
											<div class="alert-text">
												<?php echo __('backend/bitcoin.connection_error', [
													'url' => route('backend-system-payments')
												]); ?>

											</div>
										</div>

									<?php endif; ?>
								</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mumar/Projects/openfraudcart/resources/views/backend/bitcoin/dashboard.blade.php ENDPATH**/ ?>