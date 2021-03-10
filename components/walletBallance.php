                                        <div class="card card-custom bgi-no-repeat gutter-b mh-50 sticky" data-sticky="true" data-margin-top="140" data-sticky-for="1023" data-sticky-class="stickyjs" style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-1.svg)">
											<!--begin::Body-->
											<div class="card-body">
												<i class="fas fa-wallet icon-3x text-primary"></i>
												<span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block"><?php echo $appInfo->currency_code.number_format($user->currentUser->walletBalance,2)?></span>
												<span class="font-weight-bold text-muted font-size-sm">Wallet Balance</span>
											</div>
											<!--end::Body-->
										</div>