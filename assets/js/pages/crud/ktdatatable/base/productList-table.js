'use strict';
// Class definition

var KTDatatableHtmlTableDemo = function() {
  // Private functions

  // demo initializer
  var demo = function() {
    var product_list_datatable = $('#product_list_datatable').KTDatatable({
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
          sortable: false,
          sortable: 'asc',
          width: 70,
          type: 'number',
          selector: false,
          textAlign: 'center',
        },
        {
          field: 'Product Name',
          autoHide: false,
          sortable: false,
        },
        {
          field: 'Category',
          sortable: true,
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

    $('#kt_datatable_search_status').on('change', function() {
      product_list_datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#kt_datatable_search_type').on('change', function() {
      product_list_datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
  };

  return {
    init: function() {
      // init dmeo
      demo();
    },
  };
}();

jQuery(document).ready(function() {
  KTDatatableHtmlTableDemo.init();
});
