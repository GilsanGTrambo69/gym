(function($) {
    "use strict";

    // Preloader
    $(window).on('load', function() {
        $("#preloader").fadeOut(500);
    });

    // Mobile Menu Toggle
    $('.admin-menu-toggle').on('click', function() {
        $('.admin-mobile-menu').addClass('active');
    });

    $('.close-btn').on('click', function() {
        $('.admin-mobile-menu').removeClass('active');
    });

    // Add Class Modal
    $('#addClassBtn').on('click', function() {
        $('#addClassModal').addClass('active');
    });

    $('.add-class-btn').on('click', function() {
        $('#addClassModal').addClass('active');
    });

    $('.close-modal, #cancelAddClass').on('click', function() {
        $('#addClassModal').removeClass('active');
    });

    // Delete Confirmation Modal
    $('.action-btn.delete').on('click', function() {
        // Get class info from the parent elements
        const classCell = $(this).closest('.class-cell');
        const className = classCell.find('h4').text();
        const trainerName = classCell.find('p').text();
        const dayIndex = classCell.index();
        const timeCell = classCell.closest('tr').find('.time-cell').text();
        
        // Get day name based on index
        const days = ['', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        const dayName = days[dayIndex];
        
        // Update delete confirmation text
        $('.delete-class-info').text(`${className} - ${trainerName} (${dayName}, ${timeCell})`);
        
        // Show modal
        $('#deleteConfirmModal').addClass('active');
    });

    $('.close-modal, #cancelDelete').on('click', function() {
        $('#deleteConfirmModal').removeClass('active');
    });

    // Confirm Delete
    $('#confirmDelete').on('click', function() {
        // Here you would typically make an AJAX call to delete the class
        // For demo purposes, we'll just close the modal and show a success message
        
        // Get the class info text
        const classInfo = $('.delete-class-info').text();
        
        // Close the modal
        $('#deleteConfirmModal').removeClass('active');
        
        // Show success message (you could implement a toast notification system)
        alert(`La clase "${classInfo}" ha sido eliminada correctamente.`);
        
        // For demo purposes, let's replace the deleted class cell with an empty one
        // In a real application, you would refresh the data or update the DOM based on server response
        setTimeout(function() {
            // Find the class cell that was being deleted (this is just a simulation)
            // In a real app, you would have a more reliable way to identify the cell
            const randomCell = $('.class-cell:not(.empty)').eq(Math.floor(Math.random() * $('.class-cell:not(.empty)').length));
            
            // Replace with empty cell
            randomCell.html('<button class="add-class-btn"><i class="fa-solid fa-plus"></i></button>').addClass('empty');
            
            // Rebind click event to the new button
            randomCell.find('.add-class-btn').on('click', function() {
                $('#addClassModal').addClass('active');
            });
        }, 500);
    });

    // Add Class Form Submit
    $('#addClassForm').on('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const className = $('#className').val();
        const trainerName = $('#classTrainer option:selected').text();
        const day = $('#classDay option:selected').text();
        const time = $('#classTime option:selected').text();
        
        // Here you would typically make an AJAX call to save the class
        // For demo purposes, we'll just close the modal and show a success message
        
        // Close the modal
        $('#addClassModal').removeClass('active');
        
        // Show success message
        alert(`Nueva clase añadida: ${className} con ${trainerName} (${day}, ${time})`);
        
        // For demo purposes, let's update a random empty cell
        // In a real application, you would refresh the data or update the DOM based on server response
        setTimeout(function() {
            // Find a random empty cell
            const emptyCells = $('.class-cell.empty');
            if (emptyCells.length > 0) {
                const randomEmptyCell = emptyCells.eq(Math.floor(Math.random() * emptyCells.length));
                
                // Get class name display text (capitalize first letter)
                let classDisplayName = className;
                if (className === 'yoga') classDisplayName = 'Yoga';
                if (className === 'pilates') classDisplayName = 'Pilates';
                if (className === 'spinning') classDisplayName = 'Spinning';
                if (className === 'crossfit') classDisplayName = 'CrossFit';
                if (className === 'boxing') classDisplayName = 'Boxeo';
                
                // Update cell content
                randomEmptyCell.html(`
                    <div class="class-info">
                        <h4>${classDisplayName}</h4>
                        <p>${trainerName}</p>
                        <div class="class-actions">
                            <button class="action-btn edit"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="action-btn delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                `).removeClass('empty');
                
                // Rebind click event to the new delete button
                randomEmptyCell.find('.action-btn.delete').on('click', function() {
                    const classCell = $(this).closest('.class-cell');
                    const className = classCell.find('h4').text();
                    const trainerName = classCell.find('p').text();
                    const dayIndex = classCell.index();
                    const timeCell = classCell.closest('tr').find('.time-cell').text();
                    
                    const days = ['', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                    const dayName = days[dayIndex];
                    
                    $('.delete-class-info').text(`${className} - ${trainerName} (${dayName}, ${timeCell})`);
                    $('#deleteConfirmModal').addClass('active');
                });
            }
        }, 500);
        
        // Reset form
        this.reset();
    });

    // Filter functionality (demo only)
    $('.schedule-filter .admin-btn').on('click', function() {
        const classFilter = $('#classFilter').val();
        const trainerFilter = $('#trainerFilter').val();
        
        // Show filtering is working (in a real app, you would filter the actual data)
        if (classFilter !== 'all' || trainerFilter !== 'all') {
            alert(`Filtro aplicado: ${classFilter !== 'all' ? 'Clase: ' + classFilter : ''} ${trainerFilter !== 'all' ? 'Entrenador ID: ' + trainerFilter : ''}`);
        }
    });

    // Print Schedule
    $('.admin-btn.secondary').on('click', function() {
        window.print();
    });

})(window.jQuery);