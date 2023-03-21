$('.availability').each(function() {
    var time_slot = $(this).data('time');
    $.ajax({
      url: '/check_availability',
      type: 'POST',
      data: { time_slot: time_slot },
      success: function(data) {
        $(this).text(`${data.availability} places available`);
      },
      error: function() {
        $(this).text('Error checking availability');
      }
    });
  });