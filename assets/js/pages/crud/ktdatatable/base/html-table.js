'use strict';
// Class definition

var KTDatatableHtmlTableDemo = function() {
  // Private functions

  // demo initializer
  var demo = function() {

    var datatable = $('#kt_datatable').KTDatatable({
      // data: {
      //   saveState: {cookie: false},
      // },
      search: {
        input: $('#kt_datatable_search_query'),
        key: 'generalSearch',
      },
      layout: {
        class: 'datatable-bordered',
        scroll: 'true',
      },
      columns: [
        {
          field: 'Date / Reference',
          autoHide: false,
          sortable: true,
          textAlign: 'left'
        },
        {
          field: 'Date',
          autoHide: false,
          sortable: true,
        },
        {
          field: 'Amount',
          sortable: false
        },
        {
          field: 'Previous Balance',
          sortable: false
        },
        {
          field: 'New Balance',
          sortable: false,
        }, 
        {
          field: 'Status',
          title: 'Status',
          autoHide: false,
          sortable: false,
          // callback function support for column rendering
          template: function(row) {
            var status = {
              1: {
                'title': 'Pending',
                'class': ' label-light-warning',
              },
              2: {
                'title': 'Declined',
                'class': ' label-light-danger',
              },
              3: {
                'title': 'Approved',
                'class': ' label-light-success',
              },
              6: {
                'title': 'Successful',
                'class': ' label-light-success',
              },
            };
            return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
          },
        }, 
        {
          field: 'Method',
          title: 'Method',
          autoHide: false,
          sortable: false,
          // callback function support for column rendering
          template: function(row) {
            var status = {
              'auto_fund': {
                'title': 'Auto Funding',
                'state': 'primary',
              },
              'manual': {
                'title': 'Manual Funding',
                'state': 'info',
              }
            };
            return '<span class="label label-' + status[row.Method].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.Method].state + '">' + status[row.Method].title + '</span>';
          },
        },
        {
          field: 'Type',
          title: 'Type',
          autoHide: false,
          sortable: false,
          // callback function support for column rendering
          template: function(row) {
            var status = {
              1: {
                'title': 'Fund Wallet',
                'state': 'primary',
              },
              2: {
                'title': 'Recieve Money',
                'state': 'info',
              },
              3: {
                'title': 'Send Money',
                'state': 'info',
              },
              4: {
                'title': 'Purchase',
                'state': 'warning',
              },
              5: {
                'title': 'Withdrawal',
                'state': 'danger',
              },
            };
            return '<span class="label label-' + status[row.Type].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
          },
        },
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
    // Public functions
    init: function() {
      // init dmeo
      demo();
    },
  };
}();

jQuery(document).ready(function() {
  KTDatatableHtmlTableDemo.init();
});
