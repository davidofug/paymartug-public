jQuery(document).ready(function() {
  jQuery("#paymart-table").DataTable();
  let fields = ['#name','#phone_number','#amount']
  //Check empty on field blur
  fields.forEach(field => {
    jQuery(field).on('blur',() => {
      if(jQuery(field).val() == '' )
        jQuery(field).addClass('has-error')
      else
        jQuery(field).removeClass('has-error')
    })
  })

  jQuery('#payout').on('click', e => {
    e.preventDefault()

    //Check empty on submit
    fields.forEach( field => (jQuery(field).val() == '' || typeof jQuery(field).val() == 'undefined') ? jQuery(field).addClass('has-error') : jQuery(field).removeClass('has-error'))
  })
});
