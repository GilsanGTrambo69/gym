(function($) {
    "use strict";

    // Register Payment Modal
    $('#registerPaymentBtn').on('click', function() {
        // Reset form
        $('#paymentForm')[0].reset();
        $('#userInfoPreview').hide();
        
        // Set current date
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        $('#paymentDate').val(formattedDate);
        
        // Show modal
        $('#paymentModal').addClass('active');
    });

    $('.close-modal, #cancelPaymentForm').on('click', function() {
        $('#paymentModal').removeClass('active');
    });

    // Search User for Payment
    $('#searchUserBtn').on('click', function() {
        const document = $('#paymentDocument').val();
        
        if (!document) {
            alert('Por favor, ingrese un número de documento.');
            return;
        }
        
        // In a real application, you would make an AJAX call to search for the user
        // For demo purposes, we'll simulate finding a user
        
        // Simulate loading
        $(this).html('<i class="fa-solid fa-spinner fa-spin"></i>');
        
        setTimeout(() => {
            // Reset button
            $(this).html('<i class="fa-solid fa-search"></i>');
            
            // Simulate finding a user based on document number
            let foundUser = null;
            
            // Check if document matches any of our sample users
            if (document === '1098765432') {
                foundUser = {
                    name: 'Ana Martínez',
                    email: 'ana.martinez@email.com',
                    phone: '601-234-5678',
                    membership: 'Mensual',
                    status: 'Al día',
                    nextPayment: '15/06/2025'
                };
            } else if (document === '1087654321') {
                foundUser = {
                    name: 'Carlos Rodríguez',
                    email: 'carlos.rodriguez@email.com',
                    phone: '602-345-6789',
                    membership: 'Mensual',
                    status: 'Pendiente',
                    nextPayment: '05/06/2025'
                };
            } else if (document === '1076543210') {
                foundUser = {
                    name: 'Laura Gómez',
                    email: 'laura.gomez@email.com',
                    phone: '603-456-7890',
                    membership: 'Mensual',
                    status: 'Vencido',
                    nextPayment: '01/05/2025'
                };
            }
            
            if (foundUser) {
                // Update user info preview
                $('#userName').text(foundUser.name);
                $('#userEmail').text(foundUser.email);
                $('#userPhone').text(foundUser.phone);
                $('#userMembership').text(foundUser.membership);
                $('#userPaymentStatus').text(foundUser.status);
                $('#userNextPayment').text(foundUser.nextPayment);
                
                // Show user info preview
                $('#userInfoPreview').show();
                
                // Set payment amount based on membership type
                if (foundUser.membership === 'Mensual') {
                    $('#paymentAmount').val(80000);
                    $('#paymentType').val('monthly');
                } else if (foundUser.membership === 'Trimestral') {
                    $('#paymentAmount').val(210000);
                    $('#paymentType').val('quarterly');
                } else if (foundUser.membership === 'Anual') {
                    $('#paymentAmount').val(750000);
                    $('#paymentType').val('annual');
                }
            } else {
                alert('No se encontró ningún usuario con el documento ' + document);
                $('#userInfoPreview').hide();
            }
        }, 800);
    });

    // Payment Type Change
    $('#paymentType').on('change', function() {
        const paymentType = $(this).val();
        
        // Set default amounts based on payment type
        if (paymentType === 'monthly') {
            $('#paymentAmount').val(80000);
        } else if (paymentType === 'quarterly') {
            $('#paymentAmount').val(210000);
        } else if (paymentType === 'annual') {
            $('#paymentAmount').val(750000);
        } else if (paymentType === 'enrollment') {
            $('#paymentAmount').val(50000);
        } else {
            $('#paymentAmount').val('');
        }
    });

    // Payment Form Submit
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const document = $('#paymentDocument').val();
        const userName = $('#userName').text();
        const paymentType = $('#paymentType').val();
        const paymentMethod = $('#paymentMethod').val();
        const amount = $('#paymentAmount').val();
        const date = $('#paymentDate').val();
        
        // Validate user info
        if (userName === '-') {
            alert('Por favor, busque un usuario válido antes de registrar el pago.');
            return;
        }
        
        // Here you would typically make an AJAX call to save the payment
        // For demo purposes, we'll just close the modal and show a success message
        
        // Format payment type for display
        let paymentTypeText = '';
        if (paymentType === 'monthly') paymentTypeText = 'Mensualidad';
        else if (paymentType === 'quarterly') paymentTypeText = 'Trimestral';
        else if (paymentType === 'annual') paymentTypeText = 'Anual';
        else if (paymentType === 'enrollment') paymentTypeText = 'Matrícula';
        else paymentTypeText = 'Otro';
        
        // Format payment method for display
        let paymentMethodText = '';
        if (paymentMethod === 'cash') paymentMethodText = 'Efectivo';
        else if (paymentMethod === 'credit') paymentMethodText = 'Tarjeta de Crédito';
        else if (paymentMethod === 'debit') paymentMethodText = 'Tarjeta de Débito';
        else if (paymentMethod === 'transfer') paymentMethodText = 'Transferencia';
        
        // Close the modal
        $('#paymentModal').removeClass('active');
        
        // Show success message
        alert(`Pago registrado correctamente para ${userName}.\nMonto: $${amount}\nTipo: ${paymentTypeText}\nForma de pago: ${paymentMethodText}`);
        
        // For demo purposes, let's update the table
        // In a real application, you would refresh the data or update the DOM based on server response
        
        // Format date for display
        const dateObj = new Date(date);
        const formattedDate = `${dateObj.getDate().toString().padStart(2, '0')}/${(dateObj.getMonth() + 1).toString().padStart(2, '0')}/${dateObj.getFullYear()}`;
        
        // Generate a random time
        const hours = Math.floor(Math.random() * 12) + 8;
        const minutes = Math.floor(Math.random() * 60);
        const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        
        // Generate a random payment ID
        const paymentId = 'PAG-' + (Math.floor(Math.random() * 900) + 100);
        
        // Add a new row to the table
        const newRow = `
            <tr>
                <td>${paymentId}</td>
                <td>${formattedDate}</td>
                <td>${formattedTime}</td>
                <td>${document}</td>
                <td>${userName}</td>
                <td>${paymentMethodText}</td>
                <td>${paymentTypeText}</td>
                <td>$${Number(amount).toLocaleString()}</td>
                <td>
                    <div class="table-actions">
                        <button class="action-btn view" title="Ver detalles"><i class="fa-solid fa-eye"></i></button>
                        <button class="action-btn download" title="Descargar recibo"><i class="fa-solid fa-download"></i></button>
                    </div>
                </td>
            </tr>
        `;
        $('.admin-table tbody').prepend(newRow);
        
        // Rebind click events to the new buttons
        $('.admin-table tbody tr:first-child .action-btn.view').on('click', function() {
            showPaymentDetails(paymentId, formattedDate, formattedTime, document, userName, paymentTypeText, paymentMethodText, amount);
        });
        
        $('.admin-table tbody tr:first-child .action-btn.download').on('click', function() {
            alert(`Descargando recibo de pago ${paymentId}...`);
        });
    });

    // View Payment Details
    $('.action-btn.view').on('click', function() {
        const row = $(this).closest('tr');
        const paymentId = row.find('td:eq(0)').text();
        const date = row.find('td:eq(1)').text();
        const time = row.find('td:eq(2)').text();
        const document = row.find('td:eq(3)').text();
        const name = row.find('td:eq(4)').text();
        const paymentMethod = row.find('td:eq(5)').text();
        const paymentType = row.find('td:eq(6)').text();
        const amount = row.find('td:eq(7)').text();
        
        showPaymentDetails(paymentId, date, time, document, name, paymentType, paymentMethod, amount);
    });

    // Function to show payment details
    function showPaymentDetails(id, date, time, document, name, type, method, amount) {
        // Update payment details
        $('#detailPaymentId').text(id);
        $('#detailDateTime').text(`${date} ${time}`);
        $('#detailUser').text(`${name} (${document})`);
        $('#detailPaymentType').text(type);
        $('#detailPaymentMethod').text(method);
        $('#detailAmount').text(amount);
        $('#detailRegisteredBy').text('Admin');
        $('#detailNotes').text(`Pago de ${type.toLowerCase()} correspondiente a ${getMonthName(date)}.`);
        
        // Show modal
        $('#paymentDetailsModal').addClass('active');
    }

    // Helper function to get month name from date
    function getMonthName(dateStr) {
        const months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        const parts = dateStr.split('/');
        return months[parseInt(parts[1]) - 1] + ' ' + parts[2];
    }

    // Close Payment Details Modal
    $('.close-modal').on('click', function() {
        $('#paymentDetailsModal').removeClass('active');
    });

    // Print Receipt
    $('#printReceipt').on('click', function() {
        alert('Imprimiendo recibo de pago...');
    });

    // Download Receipt
    $('#downloadReceipt, .action-btn.download').on('click', function() {
        alert('Descargando recibo de pago...');
    });

    // Filter functionality (demo only)
    $('.users-filter .search-btn').on('click', function() {
        const searchTerm = $('#searchPayment').val();
        const dateRangeFilter = $('#dateRangeFilter').val();
        const paymentMethodFilter = $('#paymentMethodFilter').val();
        
        // Show filtering is working (in a real app, you would filter the actual data)
        if (searchTerm || dateRangeFilter !== 'all' || paymentMethodFilter !== 'all') {
            alert(`Filtro aplicado: ${searchTerm ? 'Búsqueda: ' + searchTerm : ''} ${dateRangeFilter !== 'all' ? 'Rango de fechas: ' + dateRangeFilter : ''} ${paymentMethodFilter !== 'all' ? 'Forma de pago: ' + paymentMethodFilter : ''}`);
        }
    });

    // Export functionality (demo only)
    $('.admin-btn.secondary').on('click', function() {
        alert('Exportando datos de pagos...');
    });

    // Pagination functionality (demo only)
    $('.pagination-btn').not(':disabled').on('click', function() {
        $('.pagination-btn').removeClass('active');
        $(this).addClass('active');
        
        // In a real app, you would load the corresponding page of data
        alert('Cargando página ' + $(this).text() + ' de pagos...');
    });

})(window.jQuery);