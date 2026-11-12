//
jq = $no.conflict();

jq(document).ready(function() {
    // Hide the success message after 3 seconds
    setTimeout(function() {
        jq('#success-message').fadeOut('slow');
    }, 3000);
});
