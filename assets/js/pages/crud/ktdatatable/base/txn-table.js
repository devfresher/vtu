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
          autoHide: false,
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

    var product_list_datatable = $('#product_list_datatable').KTDatatable({
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
          field: 'S/N',
          autoHide: false,
        },
        {
          field: 'Product Name',
          autoHide: false,
          sortable: false,
        },
        {
          field: 'Category',
          sortable: false,
          autoHide: false,
        }, 
        {
          field: 'Company Price',
          sortable: false,
          autoHide: false,
        }, 
        {
          field: 'Cost Price',
          sortable: false,
        }
      ],
    });

    var receipt_datatable = $('#receipt_datatable').KTDatatable({
      // data: {
      //   saveState: {cookie: false},
      // },
      pagination: false,
      sortable: false,
      fontSize: '20px',
      layout: {
        class: '',
        scroll: 'true',
        pagination: false
      },
      columns: [
        {
          field: 'DESCRIPTION',
          autoHide: false,
          sortable: false,
        },
        {
          field: 'RECEIPIENT',
          autoHide: false,
          sortable: false,
        },
        {
          field: 'AMOUNT PAID',
          title: 'AMOUNT PAID',
          sortable: false,
          autoHide: false,
        }, 
        {
          field: 'STATUS',
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
            return '<span class="label font-weight-bold label-lg' + status[row.STATUS].class + ' label-inline">' + status[row.STATUS].title + '</span>';
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
      receipt_datatable();
    },
  };
}();

jQuery(document).ready(function() {
  KTDatatableHtmlTableDemo.init();
});
