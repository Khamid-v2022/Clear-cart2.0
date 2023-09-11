<?php $__env->startSection('content'); ?>
	<!-- begin:: Content Head -->
	<div class="k-content__head	k-grid__item">
		<div class="k-content__head-main">
			<h3 class="k-content__head-title"><?php echo e(__('backend/dashboard.title')); ?></h3>
			<div class="k-content__head-breadcrumbs">
				<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
				<span class="k-content__head-breadcrumb-separator"></span>
				<a href="" class="k-content__head-breadcrumb-link"><?php echo e(__('backend/dashboard.title')); ?></a>
			</div>
		</div>
	</div>
	<!-- end:: Content Head -->

	<!-- begin:: Content Body -->
	<div class="k-content__body	k-grid__item k-grid__item--fluid">
	
		<!--begin::Dashboard 4-->
		<!--begin::Row-->
		<div class="row">
			<div class="col-lg-3 col-sm-6 order-lg-1 order-xl-1">

				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head  k-portlet__head--noborder">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title"><?php echo e(__('backend/dashboard.tickets_total.widget_title')); ?></h3>
						</div>
					</div>
					<div class="k-portlet__body k-portlet__body--fluid">
						<div class="k-widget-20">
							<div class="k-widget-20__title">
								<div class="k-widget-20__label"><?php echo e(App\Models\UserTicket::where('status', 'open')->count()); ?></div>
								<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
							</div>
						</div>
					</div>
				</div>

				<!--end::Portlet-->
			</div>

			<div class="col-lg-3 col-sm-6 order-lg-1 order-xl-1">
				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head  k-portlet__head--noborder">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title"><?php echo e(__('backend/dashboard.products_total.widget_title')); ?></h3>
						</div>
					</div>
					<div class="k-portlet__body k-portlet__body--fluid">
						<div class="k-widget-20">
							<div class="k-widget-20__title">
								<div class="k-widget-20__label"><?php echo e(App\Models\Product::count()); ?></div>
								<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
							</div>
						</div>
					</div>
				</div>
				<!--end::Portlet-->
			</div>
			

			<div class="col-lg-3 col-sm-6 order-lg-1 order-xl-1">
				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head  k-portlet__head--noborder">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title"><?php echo e(__('backend/dashboard.users_total.widget_title')); ?></h3>
						</div>
					</div>
					<div class="k-portlet__body k-portlet__body--fluid">
						<div class="k-widget-20">
							<div class="k-widget-20__title">
								<div class="k-widget-20__label"><?php echo e(App\Models\User::count()); ?></div>
								<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
							</div>
						</div>
					</div>
				</div>
				<!--end::Portlet-->
			</div>

			<div class="col-lg-3 col-sm-6 order-lg-1 order-xl-1">
				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head  k-portlet__head--noborder">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title"><?php echo e(__('backend/dashboard.total_orders.widget_title')); ?></h3>
						</div>
					</div>
					<div class="k-portlet__body k-portlet__body--fluid">
						<div class="k-widget-20">
							<div class="k-widget-20__title">
								<div class="k-widget-20__label"><?php echo e(App\Models\Setting::get('shop.total_sells', 0)); ?></div>
								<img class="k-widget-20__bg" src="<?php echo e(asset_dir('admin/assets/media/misc/iconbox_bg.png')); ?>" alt="bg" />
							</div>
						</div>
					</div>
				</div>
				<!--end::Portlet-->
			</div>
		</div>

		<div class="row">

			<div class="col-lg-6 col-xl-4 order-lg-2 order-xl-1">
				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid-half k-widget-12">
					<div class="k-portlet__body">
						<div class="k-widget-12__body">
							<div class="k-widget-12__head">
								<div class="k-widget-12__date k-widget-12__date--warning">
									<span class="k-widget-12__day"><?php echo e(date('d', time())); ?></span>
									<span class="k-widget-12__month"><?php echo e(__('backend/dashboard.months_number.' . date('m', time()))); ?></span>
								</div>
								<div class="k-widget-12__label">
									<h3 class="k-widget-12__title"><?php echo e(__('backend/dashboard.today_profit')); ?></h3>
									<span class="k-widget-12__desc">
										<?php echo e(App\Models\UserOrder::getFormattedTodayWin()); ?>

									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end::Portlet-->

				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid-half k-widget-13">
					<div class="k-portlet__body">
						<div id="k-widget-slider-13-2" class="k-slider carousel slide" data-ride="carousel" data-interval="4000">
							<div class="k-slider__head">
								<div class="k-slider__label"><?php echo e(__('backend/dashboard.bestseller.widget_title')); ?></div>
								<div class="k-slider__nav">
									<a class="k-slider__nav-prev carousel-control-prev" href="#k-widget-slider-13-2" role="button" data-slide="prev">
										<i class="fa fa-angle-left"></i>
									</a>
									<a class="k-slider__nav-next carousel-control-next" href="#k-widget-slider-13-2" role="button" data-slide="next">
										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</div>
							<div class="carousel-inner">
								<?php $__currentLoopData = App\Models\Product::orderByDesc('sells')->limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bestsellerProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="carousel-item <?php if($loop->iteration == 1): ?> active <?php endif; ?> k-slider__body">
									<div class="k-widget-13">
										<div class="k-widget-13__body">
											<a class="k-widget-13__title" href="<?php echo e(route('product-page', $bestsellerProduct->id)); ?>" target="_product">
												<span class="kt-widget-15__foot-label btn btn-sm btn-label-brand btn-bold" style="margin-right: 5px;">
													<?php echo e($loop->iteration); ?>.
												</span>
												<?php echo e($bestsellerProduct->name); ?>

											</a>
											<div class="k-widget-13__desc">
												<b><?php echo e(__('backend/dashboard.bestseller.price')); ?></b>
												<?php echo e($bestsellerProduct->getFormattedPrice()); ?>

											</div>
										</div>
									</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
				</div>
				<!--end::Portlet-->
			</div>

			<div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1">
				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head k-portlet__head--lg k-portlet__head--noborder k-portlet__head--break-sm">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title">
								<?php echo e(__('backend/dashboard.recent_orders.title')); ?>

								<small><?php echo e(__('backend/dashboard.recent_orders.total', ['total' => App\Models\UserOrder::count()])); ?></small>
							</h3>
						</div>
					</div>
					<div class="k-portlet__body k-portlet__body--fit">
						<div class="k-datatable" id="k_recent_orders"></div>
					</div>
				</div>
				<!--end::Portlet-->
			</div>
		</div>

		<!--end::Row-->

		<!--begin::Row-->
		<div class="row">
			<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">

				<!--begin::Portlet-->
				<div class="k-portlet k-portlet--height-fluid">
					<div class="k-portlet__head k-portlet__head--lg k-portlet__head--noborder k-portlet__head--break-sm">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title">
								<?php echo e(__('backend/dashboard.recent_tickets.title')); ?>

								<small><?php echo e(__('backend/dashboard.recent_tickets.total', ['total' => App\Models\UserTicket::count()])); ?></small>
							</h3>
						</div>
					</div>
					<div class="k-portlet__body k-portlet__body--fit">
						<div class="k-datatable" id="k_recent_tickets"></div>
					</div>
				</div>

				<!--end::Portlet-->
			</div>
		</div>

		<!--end::Row-->

		<!--end::Dashboard 4-->
		
	</div>

	<!-- end:: Content Body -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_scripts'); ?>
	<script type="text/javascript">
		var KDashboard = function() {

			var recentTicketsInit = function() {
				if ($('#k_recent_tickets').length === 0) {
					return;
				}

				var datatable = $('#k_recent_tickets').KDatatable({
					sort: null,
				
					translate: {
						records: {
							processing: 'Bitte warten...',
							noRecords: 'Keine Einträge vorhanden.',
						},
						toolbar: {
							pagination: {
								items: {
									default: {
										first: 'Erste Seite',
										prev: 'Zurück',
										next: 'Weiter',
										last: 'Letzte Seite',
										more: 'Weitere Seiten',
										input: 'Seitennummer',
										select: 'Select page size',
									}
								},
							},
						},
					},

					data: {
						type: 'remote',
						source: {
							read: {
								url: '/admin/api/recent-tickets',
							},
						},
						pageSize: 10,
						serverPaging: true,
						serverFiltering: true,
						serverSorting: true
					},

					layout: {
						scroll: true,
						footer: false,
						height: 430
					},

					sortable: false,
					pagination: false,
					search: null,

					columns: [{
						field: 'id',
						title: '#',
						sortable: false,
						width: 20,
						type: 'number',
						selector: {class: 'k-checkbox--solid k-checkbox--brand'},
						textAlign: 'center',
					}, {
						field: 'user',
						title: '<?php echo e(__('backend/dashboard.recent_tickets.user')); ?>'
					}, {
						field: 'subject',
						title: '<?php echo e(__('backend/dashboard.recent_tickets.subject')); ?>'
					}, {
						field: 'status',
						title: '<?php echo e(__('backend/dashboard.recent_tickets.status')); ?>',
						template: function(response) {
							if(response['status'] == 'closed') {
								return '\
									<span class="kt-badge kt-badge--danger kt-badge--dot kt-badge--md"></span>\
									<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/dashboard.recent_tickets.status_data.closed')); ?></span>\
								';
							} else if(response['status'] == 'replied') {
								return '\
									<span class="kt-badge kt-badge--brand kt-badge--dot kt-badge--md"></span>\
									<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/dashboard.recent_tickets.status_data.replied')); ?></span>\
								';
							}

							return '\
								<span class="kt-badge kt-badge--success kt-badge--dot kt-badge--md"></span>\
								<span class="kt-label-font-color-2 kt-font-bold"><?php echo e(__('backend/dashboard.recent_tickets.status_data.open')); ?></span>\
							';
						}
					}, {
						field: 'hire_date',
						title: '<?php echo e(__('backend/dashboard.recent_tickets.date')); ?>'
					}, {
						field: 'actions',
						title: '<?php echo e(__('backend/dashboard.recent_tickets.actions')); ?>',
						sortable: false,
						width: 80,
						overflow: 'visible',
						textAlign: 'center',
						autoHide: false,
						template: function(response) {
							return '\
								<a href="' + response['url'] + '" class="btn btn-clean  btn-sm btn-icon-md">\
									<i class="la la-edit"></i> <?php echo e(__('backend/dashboard.recent_tickets.edit')); ?>\
								</a>\
							';
						}
					}]
				});
			};
			
			var recentOrdersInit = function() {
				if ($('#k_recent_orders').length === 0) {
					return;
				}

				var datatable = $('#k_recent_orders').KDatatable({
					sort: null,
				
					translate: {
						records: {
							processing: 'Bitte warten...',
							noRecords: 'Keine Einträge vorhanden.',
						},
						toolbar: {
							pagination: {
								items: {
									default: {
										first: 'Erste Seite',
										prev: 'Zurück',
										next: 'Weiter',
										last: 'Letzte Seite',
										more: 'Weitere Seiten',
										input: 'Seitennummer',
										select: 'Select page size',
									}
								},
							},
						},
					},

					data: {
						type: 'remote',
						source: {
							read: {
								url: '/admin/api/recent-orders',
							},
						},
						pageSize: 10,
						serverPaging: true,
						serverFiltering: true,
						serverSorting: true
					},

					layout: {
						scroll: true,
						footer: false,
						height: 430
					},

					sortable: false,
					pagination: false,
					search: null,

					columns: [{
						field: 'id',
						title: '#',
						sortable: false,
						width: 20,
						type: 'number',
						// selector: {class: 'k-checkbox--solid k-checkbox--brand'},
						textAlign: 'center',
					}, {
						field: 'customer_name',
						title: '<?php echo e(__('backend/dashboard.recent_orders.user_name')); ?>'
					}, {
						field: 'price',
						title: '<?php echo e(__('backend/dashboard.recent_orders.price_with_shipping')); ?>'
					}, {
						field: 'hire_date',
						title: '<?php echo e(__('backend/dashboard.recent_orders.date')); ?>'
					}]
				});

				$('#k_form_status').on('change', function() {
					datatable.search($(this).val().toLowerCase(), 'status');
				});

				$('#k_form_type').on('change', function() {
					datatable.search($(this).val().toLowerCase(), 'type');
				});

				$('#k_form_status,#k_form_type').selectpicker();

				if (KLayout.getAsideSecondaryToggler && KLayout.getAsideSecondaryToggler()) {
					KLayout.getAsideSecondaryToggler().on('toggle', function() {
						datatable.redraw();
					});
				}

				datatable.closest('.k-content__body').find('[data-toggle="tab"]').on('shown.bs.tab', function(e) {
					datatable.redraw();
				});
			};

			return {
				init: function() {
					recentOrdersInit();
					recentTicketsInit();
				}
			};
		}();

		jQuery(document).ready(function() {
			KDashboard.init();
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\web\clear-shop\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>