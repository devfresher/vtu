                        <!--begin::Login Sign in form-->
						<div class="login-signin">
							<div class="mb-20">
								<h3>Sign In to <?php echo $appInfo->site_title; ?></h3>
								<p class="opacity-60 font-weight-bold">Enter your details to login to your account:</p>
							</div>
                            <?php if (isset($_SESSION['errorLoginMessage'])) { ?>
                                <div class="alert alert-custom alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error:</strong> <?php echo $_SESSION['errorLoginMessage'];?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } unset($_SESSION['errorLoginMessage']) ?>
							<form class="form" id="kt_login_signin_form" action="<?php echo BASE_URL?>controller/auth" method="post">
                                <input type="hidden" name="form_url" value="<?php echo BASE_URL.USER_ROOT?>login">
								<div class="form-group">
									<input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5" type="text" placeholder="Email or Phone Number" name="username" autocomplete="off" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5" type="password" placeholder="Password" name="password" />
								</div>
								<div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8">
									<div class="checkbox-inline">
										<label class="checkbox checkbox-outline checkbox-white text-white m-0">
										<input type="checkbox" name="remember" />
										<span></span>Remember me</label>
									</div>
									<a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Forget Password ?</a>
								</div>
								<div class="form-group text-center mt-10">
									<input type="submit" value="Sign In" name="login" id="kt_login_signin_submit" class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3">
								</div>
							</form>
							<div class="mt-10">
								<span class="opacity-70 mr-4">Don't have an account yet?</span>
								<a href="javascript:;" id="kt_login_signup" class="text-white font-weight-bold">Sign Up</a>
							</div>
						</div>
						<!--end::Login Sign in form-->