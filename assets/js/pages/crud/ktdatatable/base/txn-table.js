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
          field: 'Icon',
          autoHide: false,
          sortable: false,
        },
        {
          field: 'Date / Reference',
          autoHide: false,
          textAlign: 'left'
        },
        {
          field: 'Cost Price',
          sortable: false
        },
        {
          field: 'Amount & Balances',
          sortable: false,
          autoHide: false,
        }, 
        {
          field: 'Message',
          sortable: false,
          autoHide: false,
        }, 
        {
          field: 'Network / Receipient',
          sortable: false,
          autoHide: true,
          textAlign: 'left'
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
              4: {
                'title': 'Successful',
                'class': ' label-light-success',
              },
              5: {
                'title': 'Refunded',
                'class': ' label-light-info',
              },
              6: {
                'title': 'Successful',
                'class': ' label-light-success',
              },
            };
            return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
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
