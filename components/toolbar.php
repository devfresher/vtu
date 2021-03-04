                    <!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container d-flex align-items-stretch justify-content-between">
							<!--begin::Left-->
							<div class="d-flex align-items-stretch mr-3">
								<!--begin::Header Logo-->
								<div class="header-logo">
									<?php
									$app = new App($db);
									$appInfo = $app->getAppInfo();
									?>
									<a href="<?php echo BASE_URL?>index.php">
										<img alt="Logo" src="<?php echo BASE_URL.$appInfo->logo?>" class="logo-default max-h-40px" />
										<img alt="Logo" src="<?php echo BASE_URL.$appInfo->logo?>" class="logo-sticky max-h-40px" />
									</a>
								</div>
								<!--end::Header Logo-->
								<!--begin::Header Menu Wrapper-->
								<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
									<!--begin::Header Menu-->
									<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
										<!--begin::Header Nav-->
										<ul class="menu-nav">
											<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo BASE_URL.USER_ROOT?>dashboard.php" class="menu-link menu-toggle">
													<span class="menu-text">Dashboard</span>
													<i class="menu-arrow"></i>
												</a>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="<?php echo BASE_URL?>news.php" class="menu-link menu-toggle">
													<span class="menu-text">News Update</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text">Services</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
																	<span class="svg-icon"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"/>
																			<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
																			<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
																		</g>
																	</svg><!--end::Svg Icon--></span>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Airtime Topup</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="<?php echo BASE_URL.USER_ROOT?>airtime-topup.php" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Buy Airtime</span>
																			<i class="menu-arrow"></i>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Thunder-move.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" fill="#000000" />
																			<path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">KTDatatable</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Base</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/base/data-local.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Local Data</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/base/data-json.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">JSON Data</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/base/data-ajax.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Ajax Data</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/base/html-table.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">HTML Table</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/base/local-sort.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Local Sort</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/base/translation.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Translation</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Advanced</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/advanced/record-selection.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Record Selection</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/advanced/row-details.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Row Details</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/advanced/modal.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Modal Examples</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/advanced/column-rendering.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Column Rendering</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/advanced/column-width.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Column Width</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/advanced/vertical.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Vertical Scrolling</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Child Datatables</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/child/data-local.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Local Data</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/child/data-ajax.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Remote Data</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">API</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/api/methods.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">API Methods</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/ktdatatable/api/events.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Events</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Datatables.net</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Basic</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/basic/basic.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Basic Tables</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/basic/scrollable.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Scrollable Tables</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/basic/headers.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Complex Headers</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/basic/paginations.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Pagination Options</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Advanced</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/advanced/column-rendering.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Column Rendering</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/advanced/multiple-controls.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Multiple Controls</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/advanced/column-visibility.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Column Visibility</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/advanced/row-callback.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Row Callback</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/advanced/row-grouping.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Row Grouping</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/advanced/footer-callback.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Footer Callback</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Data sources</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/data-sources/html.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">HTML</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/data-sources/javascript.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Javascript</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/data-sources/ajax-client-side.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Ajax Client-side</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/data-sources/ajax-server-side.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Ajax Server-side</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Search Options</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/search-options/column-search.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Column Search</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/search-options/advanced-search.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Advanced Search</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Extensions</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/buttons.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Buttons</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/colreorder.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">ColReorder</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/keytable.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">KeyTable</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/responsive.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Responsive</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/rowgroup.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">RowGroup</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/rowreorder.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">RowReorder</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/scroller.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Scroller</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="crud/datatables/extensions/select.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-dot">
																							<span></span>
																						</i>
																						<span class="menu-text">Select</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Gift.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" fill="#000000" />
																			<path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">File Upload</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="crud/file-upload/image-input.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Image Input</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="crud/file-upload/dropzonejs.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">DropzoneJS</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="crud/file-upload/uppy.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Uppy</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
													</ul>
												</div>
											</li>
											<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text">Apps</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Gift.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" fill="#000000" />
																			<path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Users</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/user/list-default.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Default</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/user/list-datatable.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Datatable</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/user/list-columns-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Columns 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/user/list-columns-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Columns 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/user/add-user.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Add User</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/user/edit-user.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Edit User</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Address-card.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Profile</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Profile 1</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/profile/profile-1/overview.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Overview</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/profile/profile-1/personal-information.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Personal Information</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/profile/profile-1/account-information.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Account Information</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/profile/profile-1/change-password.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Change Password</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/profile/profile-1/email-settings.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Email Settings</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/profile/profile-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Profile 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/profile/profile-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Profile 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/profile/profile-4.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Profile 4</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book1.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M17,2 L19,2 C20.6568542,2 22,3.34314575 22,5 L22,19 C22,20.6568542 20.6568542,22 19,22 L17,22 L17,2 Z" fill="#000000" opacity="0.3" />
																			<path d="M4,2 L16,2 C17.6568542,2 19,3.34314575 19,5 L19,19 C19,20.6568542 17.6568542,22 16,22 L4,22 C3.44771525,22 3,21.5522847 3,21 L3,3 C3,2.44771525 3.44771525,2 4,2 Z M11.1176481,13.709585 C10.6725287,14.1547043 9.99251947,14.2650547 9.42948307,13.9835365 C8.86644666,13.7020183 8.18643739,13.8123686 7.74131803,14.2574879 L6.2303083,15.7684977 C6.17542087,15.8233851 6.13406645,15.8902979 6.10952004,15.9639372 C6.02219616,16.2259088 6.16377615,16.5090688 6.42574781,16.5963927 L7.77956724,17.0476658 C9.07965249,17.4810276 10.5130001,17.1426601 11.4820264,16.1736338 L15.4812434,12.1744168 C16.3714821,11.2841781 16.5921828,9.92415954 16.0291464,8.79808673 L15.3965752,7.53294436 C15.3725414,7.48487691 15.3409156,7.44099843 15.302915,7.40299777 C15.1076528,7.20773562 14.7910703,7.20773562 14.5958082,7.40299777 L13.0032662,8.99553978 C12.5581468,9.44065914 12.4477965,10.1206684 12.7293147,10.6837048 C13.0108329,11.2467412 12.9004826,11.9267505 12.4553632,12.3718698 L11.1176481,13.709585 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Contacts</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/contacts/list-columns.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Columns</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/contacts/list-datatable.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Datatable</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/contacts/view-contact.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">View Contact</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/contacts/add-contact.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Add Contact</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/contacts/edit-contact.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Edit Contact</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-opened.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
																			<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Chat</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/chat/private.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Private</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/chat/group.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Group</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/chat/popup.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Popup</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
																			<path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Projects</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/list-columns-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Columns 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/list-columns-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Columns 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/list-columns-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Columns 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/list-columns-4.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Columns 4</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/list-datatable.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">List - Datatable</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/view-project.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">View Project</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/add-project.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Add Project</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/projects/edit-project.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Edit Project</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Shield-check.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
																			<path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Support Center</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/support-center/home-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Home 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/support-center/home-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Home 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/support-center/faq-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">FAQ 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/support-center/faq-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">FAQ 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/support-center/faq-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">FAQ 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/support-center/feedback.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Feedback</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/support-center/license.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">License</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Thunder-move.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" fill="#000000" />
																			<path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" fill="#000000" opacity="0.3" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Todo</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/todo/tasks.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Tasks</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/todo/docs.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Docs</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/todo/files.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Files</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Clipboard-list.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
																			<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000" />
																			<rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1" />
																			<rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1" />
																			<rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1" />
																			<rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1" />
																			<rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1" />
																			<rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Education</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">School</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/school/dashboard.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Dashboard</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/school/statistics.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Statistics</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/school/calendar.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Calendar</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/school/library.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Library</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/school/teachers.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Teachers</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/school/students.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Students</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Student</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/student/dashboard.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Dashboard</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/student/profile.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Profile</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/student/calendar.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Calendar</span>
																					</a>
																				</li>
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/student/classmates.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Classmates</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
																		<a href="javascript:;" class="menu-link menu-toggle">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Class</span>
																			<i class="menu-arrow"></i>
																		</a>
																		<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																			<ul class="menu-subnav">
																				<li class="menu-item" aria-haspopup="true">
																					<a href="custom/apps/education/class/dashboard.html" class="menu-link">
																						<i class="menu-bullet menu-bullet-line">
																							<span></span>
																						</i>
																						<span class="menu-text">Dashboard</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="menu-link menu-toggle">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">eCommerce</span>
																<i class="menu-arrow"></i>
															</a>
															<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																<ul class="menu-subnav">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/dashboard.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Dashboard 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/dashboard-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Dashboard 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/dashboard-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Dashboard 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/product-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Product 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/product-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Product 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/product-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Product 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/my-orders.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">My Orders</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/order-details.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Order Details</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/shopping-cart.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Shopping Cart</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/apps/ecommerce/checkout.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-dot">
																				<span></span>
																			</i>
																			<span class="menu-text">Checkout</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<li class="menu-item" aria-haspopup="true">
															<a href="custom/apps/inbox.html" class="menu-link">
																<span class="svg-icon menu-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/Shield-check.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
																			<path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
																<span class="menu-text">Inbox</span>
																<span class="menu-label">
																	<span class="label label-danger label-inline">new</span>
																</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="menu-link menu-toggle">
													<span class="menu-text">Pages</span>
													<span class="menu-desc"></span>
													<i class="menu-arrow"></i>
												</a>
												<div class="menu-submenu menu-submenu-fixed menu-submenu-center" style="width:1150px">
													<div class="menu-subnav">
														<ul class="menu-content">
															<li class="menu-item">
																<h3 class="menu-heading menu-toggle">
																	<span class="menu-text">Pricing Tables</span>
																	<i class="menu-arrow"></i>
																</h3>
																<ul class="menu-inner">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/pricing/pricing-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Pricing Tables 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/pricing/pricing-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Pricing Tables 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/pricing/pricing-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Pricing Tables 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/pricing/pricing-4.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Pricing Tables 4</span>
																		</a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<h3 class="menu-heading menu-toggle">
																	<span class="menu-text">Wizards</span>
																	<i class="menu-arrow"></i>
																</h3>
																<ul class="menu-inner">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/wizard/wizard-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Wizard 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/wizard/wizard-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Wizard 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/wizard/wizard-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Wizard 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/wizard/wizard-4.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Wizard 4</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/wizard/wizard-5.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Wizard 5</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/wizard/wizard-6.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Wizard 6</span>
																		</a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<h3 class="menu-heading menu-toggle">
																	<i class="menu-bullet menu-bullet-dot">
																		<span></span>
																	</i>
																	<span class="menu-text">Invoices</span>
																	<i class="menu-arrow"></i>
																</h3>
																<ul class="menu-inner">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/invoices/invoice-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Invoice 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/invoices/invoice-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Invoice 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/invoices/invoice-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Invoice 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/invoices/invoice-4.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Invoice 4</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/invoices/invoice-5.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Invoice 5</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/invoices/invoice-6.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Invoice 6</span>
																		</a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<h3 class="menu-heading menu-toggle">
																	<i class="menu-bullet menu-bullet-dot">
																		<span></span>
																	</i>
																	<span class="menu-text">Login</span>
																	<i class="menu-arrow"></i>
																</h3>
																<ul class="menu-inner">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/login-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/login-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/login-3/signup.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 3</span>
																			<span class="menu-label">
																				<span class="label label-inline label-info">Wizard</span>
																			</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/login-4/signup.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 4</span>
																			<span class="menu-label">
																				<span class="label label-inline label-info">Wizard</span>
																			</span>
																		</a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<h3 class="menu-heading menu-toggle">
																	<i class="menu-bullet menu-bullet-dot">
																		<span></span>
																	</i>
																	<span class="menu-text">Classic Login</span>
																	<i class="menu-arrow"></i>
																</h3>
																<ul class="menu-inner">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/classic/login-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/classic/login-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/classic/login-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/classic/login-4.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 4</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/classic/login-5.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 5</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/login/classic/login-6.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Login 6</span>
																		</a>
																	</li>
																</ul>
															</li>
															<li class="menu-item">
																<h3 class="menu-heading menu-toggle">
																	<i class="menu-bullet menu-bullet-dot">
																		<span></span>
																	</i>
																	<span class="menu-text">Error Pages</span>
																	<i class="menu-arrow"></i>
																</h3>
																<ul class="menu-inner">
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/error/error-1.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Error 1</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/error/error-2.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Error 2</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/error/error-3.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Error 3</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/error/error-4.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Error 4</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/error/error-5.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Error 5</span>
																		</a>
																	</li>
																	<li class="menu-item" aria-haspopup="true">
																		<a href="custom/pages/error/error-6.html" class="menu-link">
																			<i class="menu-bullet menu-bullet-line">
																				<span></span>
																			</i>
																			<span class="menu-text">Error 6</span>
																		</a>
																	</li>
																</ul>
															</li>
														</ul>
													</div>
												</div>
											</li>
										</ul>
										<!--end::Header Nav-->
									</div>
									<!--end::Header Menu-->
								</div>
								<!--end::Header Menu Wrapper-->
							</div>
							<!--end::Left-->
							<!--begin::Topbar-->
							<div class="topbar">
								<!--begin::Search-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-lg btn-dropdown mr-1">
											<span class="svg-icon svg-icon-xl">
												<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</div>
									</div>
									<!--end::Toggle-->
									<!--begin::Dropdown-->
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
											<!--begin:Form-->
											<form method="get" class="quick-search-form">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<span class="svg-icon svg-icon-lg">
																<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>
																<!--end::Svg Icon-->
															</span>
														</span>
													</div>
													<input type="text" class="form-control" placeholder="Search..." />
													<div class="input-group-append">
														<span class="input-group-text">
															<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
														</span>
													</div>
												</div>
											</form>
											<!--end::Form-->
											<!--begin::Scroll-->
											<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
											<!--end::Scroll-->
										</div>
									</div>
									<!--end::Dropdown-->
								</div>
								<!--end::Search-->
								<!--begin::Notifications-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-danger">
											
											<i class="flaticon2-bell-5"></i>
											<span class="pulse-ring"></span>
										</div>
									</div>
									<!--end::Toggle-->
									<!--begin::Dropdown-->
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<form>
											<!--begin::Header-->
											<div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(assets/media/misc/bg-1.jpg)">
												<!--begin::Title-->
												<h4 class="d-flex flex-center rounded-top">
													<span class="text-white">User Notifications</span>
													<span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span>
												</h4>
												<!--end::Title-->
												<!--begin::Tabs-->
												<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
													<li class="nav-item">
														<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">Alerts</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#topbar_notifications_events">Events</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs">Logs</a>
													</li>
												</ul>
												<!--end::Tabs-->
											</div>
											<!--end::Header-->
											<!--begin::Content-->
											<div class="tab-content">
												<!--begin::Tabpane-->
												<div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
													<!--begin::Scroll-->
													<div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-40 symbol-light-primary mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-primary">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																				<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Text-->
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Cool App</a>
																<span class="text-muted">Marketing campaign planning</span>
															</div>
															<!--end::Text-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-40 symbol-light-warning mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-warning">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
																				<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Text-->
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg">Awesome SAAS</a>
																<span class="text-muted">Project status update meeting</span>
															</div>
															<!--end::Text-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-40 symbol-light-success mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-success">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
																				<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Text-->
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Claudy Sys</a>
																<span class="text-muted">Project Deployment &amp; Launch</span>
															</div>
															<!--end::Text-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-40 symbol-light-danger mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-danger">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/General/Attachment2.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z" fill="#000000" opacity="0.3" transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)" />
																				<path d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z" fill="#000000" transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)" />
																				<path d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z" fill="#000000" opacity="0.3" transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)" />
																				<path d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z" fill="#000000" opacity="0.3" transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Text-->
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Trilo Service</a>
																<span class="text-muted">Analytics &amp; Requirement Study</span>
															</div>
															<!--end::Text-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-40 symbol-light-info mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-info">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
																				<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
																				<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Text-->
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Bravia SAAS</a>
																<span class="text-muted">Reporting Application</span>
															</div>
															<!--end::Text-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-40 symbol-light-danger mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-danger">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
																				<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Text-->
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Express Wind</a>
																<span class="text-muted">Software Analytics &amp; Design</span>
															</div>
															<!--end::Text-->
														</div>
														<!--end::Item-->
														<!--begin::Item-->
														<div class="d-flex align-items-center mb-6">
															<!--begin::Symbol-->
															<div class="symbol symbol-40 symbol-light-success mr-5">
																<span class="symbol-label">
																	<span class="svg-icon svg-icon-lg svg-icon-success">
																		<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
																				<path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
															</div>
															<!--end::Symbol-->
															<!--begin::Text-->
															<div class="d-flex flex-column font-weight-bold">
																<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Bruk Fitness</a>
																<span class="text-muted">Web Design &amp; Development</span>
															</div>
															<!--end::Text-->
														</div>
														<!--end::Item-->
													</div>
													<!--end::Scroll-->
													<!--begin::Action-->
													<div class="d-flex flex-center pt-7">
														<a href="#" class="btn btn-light-primary font-weight-bold text-center">See All</a>
													</div>
													<!--end::Action-->
												</div>
												<!--end::Tabpane-->
												<!--begin::Tabpane-->
												<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
													<!--begin::Nav-->
													<div class="navi navi-hover scroll my-4" data-scroll="true" data-height="300" data-mobile-height="200">
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-line-chart text-success"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New report has been received</div>
																	<div class="text-muted">23 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-paper-plane text-danger"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">Finance report has been generated</div>
																	<div class="text-muted">25 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-user flaticon2-line- text-success"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New order has been received</div>
																	<div class="text-muted">2 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-pin text-primary"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New customer is registered</div>
																	<div class="text-muted">3 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-sms text-danger"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">Application has been approved</div>
																	<div class="text-muted">3 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-pie-chart-3 text-warning"></i>
																</div>
																<div class="navinavinavi-text">
																	<div class="font-weight-bold">New file has been uploaded</div>
																	<div class="text-muted">5 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon-pie-chart-1 text-info"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New user feedback received</div>
																	<div class="text-muted">8 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-settings text-success"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">System reboot has been successfully completed</div>
																	<div class="text-muted">12 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon-safe-shield-protection text-primary"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New order has been placed</div>
																	<div class="text-muted">15 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-notification text-primary"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">Company meeting canceled</div>
																	<div class="text-muted">19 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-fax text-success"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New report has been received</div>
																	<div class="text-muted">23 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon-download-1 text-danger"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">Finance report has been generated</div>
																	<div class="text-muted">25 hrs ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon-security text-warning"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New customer comment recieved</div>
																	<div class="text-muted">2 days ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
														<!--begin::Item-->
														<a href="#" class="navi-item">
															<div class="navi-link">
																<div class="navi-icon mr-2">
																	<i class="flaticon2-analytics-1 text-success"></i>
																</div>
																<div class="navi-text">
																	<div class="font-weight-bold">New customer is registered</div>
																	<div class="text-muted">3 days ago</div>
																</div>
															</div>
														</a>
														<!--end::Item-->
													</div>
													<!--end::Nav-->
												</div>
												<!--end::Tabpane-->
												<!--begin::Tabpane-->
												<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
													<!--begin::Nav-->
													<div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!
													<br />No new notifications.</div>
													<!--end::Nav-->
												</div>
												<!--end::Tabpane-->
											</div>
											<!--end::Content-->
										</form>
									</div>
									<!--end::Dropdown-->
								</div>
								<!--end::Notifications-->

								<!--begin::User-->
								<?php 
								$user = new User($db);
								?>
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item">
										<div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
											<span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
											<span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4"><?php echo $user->firstname?></span>
											<span class="symbol symbol-35">
												<span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30"><?php echo $user->firstLetter?></span>
											</span>
										</div>
									</div>
									<!--end::Toggle-->
								</div>
								<!--end::User-->

							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->