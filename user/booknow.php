<form action="../api/appointments/process_booking.php" method="POST">
    // ... form contents
</form>

<script>
function cancelAppointment(id) {
    fetch('../api/appointments/cancel.php', {
        // ... fetch options
    });
}
</script> 