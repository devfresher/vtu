						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Heading-->
									<div class="d-flex flex-column">
										<!--begin::Title-->
										<h2 class="text-white font-weight-bold my-2 mr-5">
											<?php
												$break = Explode('/', SCRIPT_NAME);
												$pageFile = $break[count($break) - 1];
												echo ucwords(str_replace(array(".php","_","-"), array(""," "," "), $pageFile) . ' ');
											?>
										</h2>
										<!--end::Title-->
                                        
										<!--begin::Breadcrumb-->
										<div class="d-flex align-items-center font-weight-bold my-2">

											<!--begin::Item-->
											<a href="<?php echo BASE_URL?>" class="opacity-75 hover-opacity-100">
												<i class="flaticon2-shelter text-white icon-1x"></i>
											</a>
											<!--end::Item-->

											<?php
											 $crumbs = explode("/", str_replace(BASE_PATH, '', REQUEST_URI)); 
												foreach($crumbs as $crumb) {
											?>
													<!--begin::Item-->
													<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
													<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100"><?php echo ucfirst(str_replace(array(".php","_","-"),array(""," "," "),$crumb) . ' ');?></a>
													<!--end::Item-->
											<?php } ?>


										</div>
										<!--end::Breadcrumb-->
									</div>
									<!--end::Heading-->
								</div>
								<!--end::Info-->
								<!--begin::Toolbar-->
								<div class="d-flex align-items-center">
									<!--begin::Button-->
									<a href="<?php echo BASE_URL?>wallet.php" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">
                                        <i class="fas fa-folder-plus"></i>
                                        Fund Wallet
                                    </a>
									<!--end::Button-->
								</div>
								<!--end::Toolbar-->
							</div>
						</div>
						<!--end::Subheader-->
