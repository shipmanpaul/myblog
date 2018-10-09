<?php
/**
 * The template for displaying the footer
 *
 * @package Readable
 */
?>
<div class="footer">
    <div class="container">

        <div class="subscribe text-center" style="margin-bottom: 48px;">
            <p class="title mb-0">Join our Newsletter</p>
            <p class="text-white-50 sub-header">Get updates, news, offers, and more.</p>

            <form [formGroup]="subscribeForm">
                <div class="row justify-content-md-center">
                    <div class="col-xs-7 col-sm-4 col-sm-offset-3">
                        <input type="email" class="form-control" formControlName="email" placeholder="Enter email"
                            style='padding: 18px 12px;'>
                    </div>
                    <div class="col-xs-5 col-sm-2 text-left">
                        <button class="btn btn-primary btn-block small-xxs mt-0 font-poppins" type="button"
								id="button-addon2"> <span class="font-size-16"> Subscribe </span> </button>
                    </div>

                </div>
            </form>

        </div>

	</div><!-- /.page-content-container -->
     <div class="footer-link pt-5 text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div class="col col-md-4 col-lg-2 first hidden-sm hidden-xs">
                    <img src="http://localhost:8060/blog-numnu/wp-content/uploads/2018/10/w-logo-1.png" class="img-responsive">
                    <p class="mt-3 text-white-50">© 2018 Numnu</p>
                </div>
                 <div class="col-md-12 col-lg-10">
                    <div class="row">
                        <div class="col-xs-6 col-sm-3  pb-3">
                            <p class="text-white-50">NUMNU</p>
                            <p>
                                <a target="_blank" href="https://numnu.com/about" class="text-white bb-0"> About Numnu</a>
                            </p>
                            <p>
                                <a target="_blank" href="https://numnu.com/terms" class="text-white bb-0">Terms of Service</a>
                            </p>
                            <p>
                                <a target="_blank" href="https://numnu.com/privacy" class="text-white bb-0"> Privacy Policy</a>
                            </p>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <p class="text-white-50">PARTNER WITH US</p>
                            <p>
                                <a target="_blank" href="https://numnu.com/for-events" class="text-white bb-0">For Events</a>
                            </p>

                        </div>

                      <div class="clearfix visible-xs"></div>
                        <div class="col-xs-6 col-sm-3">
                            <p class="text-white-50"> CONNECT WITH US</p>
                            <p>
                                <a target="_blank" href="https://numnu.com/contact" class="text-white bb-0">Contact us</a>
                            </p>
                            <!-- <p>
                              <a href="#" class="text-white bb-0">Blog</a>
                          </p> -->
                            <p class="social-media">
                                <a class="bb-0 fa fa-facebook-official fa-2x text-white" href="https://www.facebook.com/numnuapp/"
                                    target="_blank">
                                    <span class="icon-facebook-app-logo pr-2"></span>
                                </a>
                                <a class="bb-0 fa fa-twitter fa-2x text-white" href="https://twitter.com/numnuapp/"
                                    target="_blank">
                                    <span class="icon-twitter-logo-silhouette pr-2"></span>
                                </a>
                                <a class="bb-0 fa fa-instagram fa-2x text-white" href="https://www.instagram.com/numnuapp/"
                                    target="_blank">
                                    <span class="icon-instagram-social-network-logo-of-photo-camera pr-2"></span>
                                </a>
                                <a class="bb-0 fa fa-envelope fa-2x text-white" href="mailto:info@numnu.com">
                                    <span class="icon-close-envelope"></span>
                                </a>
                            </p>
                        </div>
						
						<div class="col-xs-6 col-sm-3 text-right">
                        <a href="https://itunes.apple.com/ca/app/numnu/id1231472732?mt=8" target="_blank" class="btn btn-outline-light border-white text-left mb-3 small-xxs" style="
                            margin-bottom: 0!important;">
                                <span style="    float: left; margin-top: 6px;" class="icon-apple float-left mt-2 mb-2 mr-2"></span>
                                <small class="extra-small font-poppins">Available on the</small>
                                <p class="mb-0 font-size-16" style="margin-top:-5px;">App Store</p>
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=com.numnu.numnu" target="_blank"
                                class="btn btn-outline-light border-white text-left mb-3 small-xxs">
                                <span style="float: left; margin-top: 6px;" class="icon-google-play float-left mt-2 mb-2 mr-2"></span>
                                <small class="extra-small font-poppins">Available on the</small>
                                <p class="mb-0 font-size-16" style="margin-top:-5px;" >Google Play</p>
                            </a>
                        </div>

                    </div>
                    <p class="mt-3 text-white-50 hidden-lg hidden-md text-center"> © 2018 Numnu</p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<?php
	$readable_script = get_theme_mod( 'custom_js_footer', '' );

	if ( ! empty( $readable_script ) ) {
		echo PHP_EOL . $readable_script . PHP_EOL;
	}
?>						
<?php wp_footer(); ?>
<!-- W3TC-include-js-body-end -->
