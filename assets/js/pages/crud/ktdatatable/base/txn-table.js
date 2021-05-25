'use strict';
// Class definition

var KTDatatableHtmlTableDemo = function() {
  // Private functions

  // demo initializer
  var demo = function() {

    var datatable = $('#kt_datatable').KTDatatable({
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
          field: 'S/N',
          autoHide: false,
          sortable: false,
          sortable: 'asc',
          width: 70,
          type: 'number',
          selector: false,
          textAlign: 'center',
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
              0: {
                'title': 'Declined',
                'class': ' label-light-danger',
              },
              1: {
                'title': 'Pending',
                'class': ' label-light-warning',
              },
              2: {
                'title': 'Awaiting Response',
                'class': ' label-light-warning',
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
              }
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
