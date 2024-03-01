
    function deleteRecord(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: '/email-templates/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success (optional)
                    alert(response.message);
                    // You may also redirect to another page or update the UI accordingly
                },
                error: function(error) {
                    // Handle error (optional)
                    console.error('Error deleting record:', error);
                }
            });
        }
    }

