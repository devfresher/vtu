"use strict";
// Class definition

var KTDatatableColumnRenderingDemo = function() {
	// Private functions

	// basic demo
	var demo = function() {

		var datatable = $('#plan_list_datatable').KTDatatable({
			// layout definition
			layout: {
				class: 'datatable-bordered',
        		scroll: 'true',
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#kt_datatable_search_query'),
				delay: 400,
				key: 'generalSearch'
			},

			// columns definition
			columns: [
				{
					field: 'S/N',
					title: 'S/N',
					sortable: 'asc',
					width: 70,
					type: 'number',
					selector: false,
				},{
					field: 'Plan Name',
					sortable: 'asc',
				},{
					field: 'Migration Fee',
					sortable: false,
				},{
					field: 'planType',
                    title: 'Plan Type',
					sortable: false,

                    // callback function support for column rendering
					template: function(row) {
						var status = {
							'public': {'title': 'Public', 'class': 'success'},
							'private': {'title': 'Private', 'class': 'danger'},
						};
                        return '<span class="label font-weight-bold label-lg label-' + status[row.planType].class + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.planType].class + '">' +
                        status[row.planType].title + '</span>';					},
				}, {
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 125,
					overflow: 'visible',
					autoHide: false,
				}],
		});

		$('#product_plan_datatable').KTDatatable({


			// layout definition
			layout: {
				overflow: 'visible',
				class: 'datatable-bordered',
				scroll: true,
			},

			// column sorting
			sortable: true,

			pagination: false,

			search: {
				input: $('#kt_datatable_search_query'),
				delay: 400,
				key: 'generalSearch'
			},

			// columns definition
			columns: [
				
			],
		});


		$('#sms_settings_datatable').KTDatatable({


			// layout definition
			layout: {
				overflow: 'visible',
				class: 'datatable-bordered',
				scroll: true,
			},

			// column sorting
			sortable: true,

			pagination: false,

			search: {
				input: $('#kt_datatable_search_query'),
				delay: 400,
				key: 'generalSearch'
			},

			// columns definition
			columns: [
				
			],
		});

		$('#kt_datatable_search_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});

		$('#kt_datatable_search_type').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

	};

	return {
		// public functions
		init: function() {
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableColumnRenderingDemo.init();
});
