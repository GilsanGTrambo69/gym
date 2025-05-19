(function($) {
    "use strict";

    // Add User Modal
    $('#addUserBtn').on('click', function() {
        // Reset form and change title to Add
        $('#userForm')[0].reset();
        $('#userModal .admin-modal-header h3').text('Añadir Nuevo Usuario');
        $('#userModal').addClass('active');
    });

    $('.close-modal, #cancelUserForm').on('click', function() {
        $('#userModal').removeClass('active');
    });

    // Edit User
    $('.action-btn.edit').on('click', function() {
        // Get user data from the row
        const row = $(this).closest('tr');
        const document = row.find('td:eq(0)').text();
        const firstName = row.find('td:eq(1)').text();
        const lastName = row.find('td:eq(2)').text();
        const email = row.find('td:eq(3)').text();
        const phone = row.find('td:eq(4)').text();
        
        // Fill the form with user data
        $('#userDocument').val(document);
        $('#userFirstName').val(firstName);
        $('#userLastName').val(lastName);
        $('#userEmail').val(email);
        $('#userPhone').val(phone);
        
        // Change modal title to Edit
        $('#userModal .admin-modal-header h3').text('Editar Usuario');
        
        // Show modal
        $('#userModal').addClass('active');
    });

    // View User Details
    $('.action-btn.view').on('click', function() {
        // In a real application, you would fetch user details from the server
        // For demo purposes, we'll just show an alert
        const row = $(this).closest('tr');
        const name = row.find('td:eq(1)').text() + ' ' + row.find('td:eq(2)').text();
        const document = row.find('td:eq(0)').text();
        
        alert(`Detalles del usuario: ${name} (${document})`);
    });

    // Delete User
    $('.action-btn.delete').on('click', function() {
        // Get user info from the row
        const row = $(this).closest('tr');
        const firstName = row.find('td:eq(1)').text();
        const lastName = row.find('td:eq(2)').text();
        const document = row.find('td:eq(0)').text();
        
        // Update delete confirmation text
        $('.delete-user-info').text(`${firstName} ${lastName} (${document})`);
        
        // Show modal
        $('#deleteUserModal').addClass('active');
    });

    $('.close-modal, #cancelDeleteUser').on('click', function() {
        $('#deleteUserModal').removeClass('active');
    });

    // Confirm Delete User
    $('#confirmDeleteUser').on('click', function() {
        // Here you would typically make an AJAX call to delete the user
        // For demo purposes, we'll just close the modal and show a success message
        
        // Get the user info text
        const userInfo = $('.delete-user-info').text();
        
        // Close the modal
        $('#deleteUserModal').removeClass('active');
        
        // Show success message
        alert(`El usuario "${userInfo}" ha sido eliminado correctamente.`);
        
        // For demo purposes, let's remove the row from the table
        // In a real application, you would refresh the data or update the DOM based on server response
        setTimeout(function() {
            // Find a random row to remove (this is just a simulation)
            // In a real app, you would have a more reliable way to identify the row
            const randomRow = $('.admin-table tbody tr').eq(Math.floor(Math.random() * $('.admin-table tbody tr').length));
            randomRow.fadeOut(400, function() {
                $(this).remove();
            });
        }, 500);
    });

    // User Form Submit
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const document = $('#userDocument').val();
        const firstName = $('#userFirstName').val();
        const lastName = $('#userLastName').val();
        const email = $('#userEmail').val();
        const phone = $('#userPhone').val();
        const membership = $('#userMembership').val();
        
        // Here you would typically make an AJAX call to save the user
        // For demo purposes, we'll just close the modal and show a success message
        
        // Close the modal
        $('#userModal').removeClass('active');
        
        // Show success message
        const isEdit = $('#userModal .admin-modal-header h3').text().includes('Editar');
        const message = isEdit ? 
            `Usuario "${firstName} ${lastName}" actualizado correctamente.` : 
            `Nuevo usuario "${firstName} ${lastName}" añadido correctamente.`;
        
        alert(message);
        
        // For demo purposes, let's update the table
        // In a real application, you would refresh the data or update the DOM based on server response
        if (!isEdit) {
            // Add a new row to the table
            const newRow = `
                <tr>
                    <td>${document}</td>
                    <td>${firstName}</td>
                    <td>${lastName}</td>
                    <td>${email}</td>
                    <td>${phone}</td>
                    <td><span class="status-badge active">Al día</span></td>
                    <td>30/06/2025</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                            <button class="action-btn edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="action-btn delete" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
            $('.admin-table tbody').prepend(newRow);
            
            // Rebind click events to the new buttons
            $('.admin-table tbody tr:first-child .action-btn.view').on('click', function() {
                alert(`Detalles del usuario: ${firstName} ${lastName} (${document})`);
            });
            
            $('.admin-table tbody tr:first-child .action-btn.edit').on('click', function() {
                $('#userDocument').val(document);
                $('#userFirstName').val(firstName);
                $('#userLastName').val(lastName);
                $('#userEmail').val(email);
                $('#userPhone').val(phone);
                $('#userModal .admin-modal-header h3').text('Editar Usuario');
                $('#userModal').addClass('active');
            });
            
            $('.admin-table tbody tr:first-child .action-btn.delete').on('click', function() {
                $('.delete-user-info').text(`${firstName} ${lastName} (${document})`);
                $('#deleteUserModal').addClass('active');
            });
        }
    });

    // Filter functionality (demo only)
    $('.users-filter .search-btn').on('click', function() {
        const searchTerm = $('#searchUser').val();
        const statusFilter = $('#statusFilter').val();
        const membershipFilter = $('#membershipFilter').val();
        
        // Show filtering is working (in a real app, you would filter the actual data)
        if (searchTerm || statusFilter !== 'all' || membershipFilter !== 'all') {
            alert(`Filtro aplicado: ${searchTerm ? 'Búsqueda: ' + searchTerm : ''} ${statusFilter !== 'all' ? 'Estado: ' + statusFilter : ''} ${membershipFilter !== 'all' ? 'Membresía: ' + membershipFilter : ''}`);
        }
    });

    // Export functionality (demo only)
    $('.admin-btn.secondary').on('click', function() {
        alert('Exportando datos de usuarios...');
    });

    // Pagination functionality (demo only)
    $('.pagination-btn').not(':disabled').on('click', function() {
        $('.pagination-btn').removeClass('active');
        $(this).addClass('active');
        
        // In a real app, you would load the corresponding page of data
        alert('Cargando página ' + $(this).text() + ' de usuarios...');
    });

})(window.jQuery);