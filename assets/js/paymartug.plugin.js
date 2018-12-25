jQuery(document).ready(function() {
  jQuery("#paymart-table").DataTable();
  let limits = {min:1000,max:1000000}
  let fields = ['#name','#phone_number','#amount']
  //Check empty on field blur
  fields.forEach(field => {
    jQuery(field).on('blur', () => {
      if(jQuery(field).val() == '' )
        jQuery(field).addClass('has-error')
      else
        jQuery(field).removeClass('has-error')

      if(field == '#phone_number' || field == '#amount' ) {
        if(!/^\d+$/.test( jQuery(field).val()) )
          jQuery(field).addClass('has-error')
        else
          jQuery(field).removeClass('has-error')
      }

      if(field == '#amount') {
        let amount = parseInt(jQuery(field).val())
        if( amount < limits.min || amount > limits.max )
          jQuery(field).addClass('has-error')
      }

    })
  })
  
  jQuery('#payout').on('click', e => {
    e.preventDefault()
    //Check empty on submit
    fields.forEach( field => {
      if(jQuery(field).val() == '' || typeof jQuery(field).val() == 'undefined') {
        jQuery(field).addClass('has-error')
        //jQuery(field).sibling('.msg-error').text('Required!')
      } else {
        jQuery(field).removeClass('has-error')
       // jQuery(field).sibling('.msg-error').text('')
      } 
    })
  })
});
