jQuery(document).ready(function($) {
  $("#paymart-table").DataTable();
  let limits = {min:1000,max:1000000}
  let fields = ['#name','#phone_number','#amount']
  //Check empty on fields blur
  fields.forEach(field => {
    $(field).on('blur', () => {
      if($(field).val() == '' )
        $(field).addClass('has-error')
      else
        $(field).removeClass('has-error')

      if(field == '#phone_number' || field == '#amount' ) {
        if(!/^\d+$/.test( $(field).val()) )
          $(field).addClass('has-error')
        else
          $(field).removeClass('has-error')
      }

      if(field == '#amount') {
        let amount = parseInt($(field).val())
        if( amount < limits.min || amount > limits.max )
          $(field).addClass('has-error')
      }

    })
  })
  
  $('#payout').on('click', e => {
    e.preventDefault()
    let errors = 0
    //Check empty on submit
    fields.forEach( field => {
      if($(field).val() == '' || typeof $(field).val() == 'undefined') {
        $(field).addClass('has-error')
        errors++
        //$(field).sibling('.msg-error').text('Required!')
      } else {
        $(field).removeClass('has-error')
       //$(field).sibling('.msg-error').text('')
        errors--
      } 
    })
    
    if(errors <=0 ) sendPayment()
  })
})