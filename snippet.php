function limit_ticket_selection() {
    global $post;

    // Check if the current page has the correct ID
    if ($post->ID == 9796) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                console.log('Limiting ticket selection script loaded.');

                var ticketQuantityInputs = $('input.tribe-common-h3.tribe-common-h4--min-medium.tribe-tickets__tickets-item-quantity-number-input');
                var maxTickets = 5;

                function logTicketCount() {
                    var totalTickets = 0;
                    ticketQuantityInputs.each(function() {
                        totalTickets += parseInt($(this).val());
                    });
                    console.log('Current ticket count: ' + totalTickets);
                }

                function updateTicketCount() {
                    var totalTickets = 0;
                    ticketQuantityInputs.each(function() {
                        totalTickets += parseInt($(this).val());
                    });
                    return totalTickets;
                }

                $('.tribe-tickets__tickets-item-quantity-add').on('click', function() {
                    // Check if adding another ticket exceeds the limit
                    if (updateTicketCount() >= maxTickets) {
                        alert('You cannot select more than ' + maxTickets + ' tickets.');
                        return false; // Prevent further action
                    }
                    // Enable all quantity inputs
                    ticketQuantityInputs.prop('disabled', false);
                    logTicketCount();
                });

                ticketQuantityInputs.on('change', function() {
                    // Check if the total ticket count exceeds the limit
                    if (updateTicketCount() > maxTickets) {
                        alert('You cannot select more than ' + maxTickets + ' tickets.');
                        $(this).val(0); // Reset the quantity
                        logTicketCount();
                    }
                    else {
                        logTicketCount();
                    }
                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'limit_ticket_selection');
