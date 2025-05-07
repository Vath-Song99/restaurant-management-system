document.addEventListener('DOMContentLoaded', function() {
    // Initialize Revenue Chart
    const revenueChart = new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue',
                data: [4500, 5300, 6200, 7800, 8900, 12426],
                borderColor: '#4e73df',
                tension: 0.3,
                fill: true,
                backgroundColor: 'rgba(78, 115, 223, 0.05)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [2],
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Initialize Order Statistics Chart
    const orderStats = new Chart(document.getElementById('orderStats'), {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Cancelled'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '75%'
        }
    });

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    darkModeToggle.addEventListener('click', () => {
        body.setAttribute('data-theme',
            body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark'
        );

        // Update icon
        const icon = darkModeToggle.querySelector('i');
        icon.classList.toggle('fa-moon');
        icon.classList.toggle('fa-sun');
    });

    // Sidebar Toggle for Mobile
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        });
    }

    // Initialize all tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize all popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Add smooth scrolling to all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});


$(document).ready(function() {
    // Toggle sidebar
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
    
    // Navigation between sections
    $('.nav-link').on('click', function(e) {
        e.preventDefault();
        
        const targetSection = $(this).data('section');
        
        // Hide all dashboard sections
        $('.dashboard-section').hide();
        
        // Show the target section
        $('#' + targetSection).show();
        
        // Update active state in sidebar
        $('.nav-link').parent().removeClass('active');
        $(this).parent().addClass('active');
    });
    
    // Order filter buttons
    $('.filter-btn').on('click', function() {
        const filter = $(this).data('filter');
        
        // Update active button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        if (filter === 'all') {
            $('.order-row').show();
        } else {
            $('.order-row').hide();
            $('.order-row[data-status="' + filter + '"]').show();
        }
    });
    
    // Update order status
    $('#save-order-status-btn').on('click', function() {
        const orderId = $('#order-id-input').val();
        const status = $('#order-status-select').val();
        const notes = $('#order-notes').val();
        
        // Here you would normally make an AJAX call to update the order
        console.log(`Updating order ${orderId} to status: ${status}`);
        
        // For demo purposes, update the UI directly
        $(`.order-row[data-order-id="${orderId}"]`).attr('data-status', status);
        
        // Update the badge
        let badgeClass = 'bg-warning text-dark';
        let statusText = 'Pending';
        
        if (status === 'in-progress') {
            badgeClass = 'bg-info text-dark';
            statusText = 'In Progress';
        } else if (status === 'completed') {
            badgeClass = 'bg-success';
            statusText = 'Completed';
        }
        
        $(`.order-row[data-order-id="${orderId}"] .badge`)
            .removeClass()
            .addClass(`badge ${badgeClass}`)
            .text(statusText);
        
        // Close the modal
        $('#updateOrderModal').modal('hide');
        
        // Show success message
        alert('Order status updated successfully!');
    });
    
    // Save reservation
    $('#save-reservation-btn').on('click', function() {
        // Validate form
        if (!$('#addReservationForm')[0].checkValidity()) {
            $('#addReservationForm')[0].reportValidity();
            return;
        }
        
        // Here you would normally make an AJAX call to save the reservation
        console.log('Saving new reservation');
        
        // Close the modal
        $('#addReservationModal').modal('hide');
        
        // Show success message
        alert('Reservation added successfully!');
        
        // Reset form
        $('#addReservationForm')[0].reset();
    });
    
    // Save special menu item
    $('#save-special-btn').on('click', function() {
        // Validate form
        if (!$('#addSpecialForm')[0].checkValidity()) {
            $('#addSpecialForm')[0].reportValidity();
            return;
        }
        
        // Here you would normally make an AJAX call to save the special
        console.log('Saving new special menu item');
        
        // Close the modal
        $('#addSpecialModal').modal('hide');
        
        // Show success message
        alert('Special menu item added successfully!');
        
        // Reset form
        $('#addSpecialForm')[0].reset();
    });
    
    // Initialize with dashboard view
    $('.dashboard-section').hide();
    $('#dashboard-overview').show();
    
    // Set up modal data
    $('#updateOrderModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const orderId = button.data('order-id');
        const modal = $(this);
        
        modal.find('#order-id-input').val(orderId);
        modal.find('#updateOrderModalLabel').text(`Update Order #${orderId}`);
    });
});

// Function to confirm reservation
function confirmReservation(reservationId) {
    // Here you would normally make an AJAX call to confirm the reservation
    console.log(`Confirming reservation ${reservationId}`);
    
    // For demo purposes, update the UI directly
    $(`tr:has(button[data-reservation-id="${reservationId}"]) .badge`)
        .removeClass('bg-warning text-dark')
        .addClass('bg-info')
        .text('Confirmed');
    
    // Replace the confirm button with edit/cancel buttons
    const actionCell = $(`tr:has(button[data-reservation-id="${reservationId}"]) td:last-child`);
    actionCell.html(`
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateReservationModal" data-reservation-id="${reservationId}">Edit</button>
        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelReservationModal" data-reservation-id="${reservationId}">Cancel</button>
    `);
    
    // Show success message
    alert('Reservation confirmed successfully!');
}

// Function to deactivate special
function deactivateSpecial(itemId) {
    if (confirm('Are you sure you want to deactivate this special menu item?')) {
        // Here you would normally make an AJAX call to deactivate the special
        console.log(`Deactivating special menu item ${itemId}`);
        
        // For demo purposes, update the UI directly
        $(`tr:has(button[onclick="deactivateSpecial(${itemId})"]) .badge`)
            .removeClass('bg-success')
            .addClass('bg-secondary')
            .text('Inactive');
        
        // Replace the deactivate button with activate button
        const actionCell = $(`tr:has(button[onclick="deactivateSpecial(${itemId})"]) td:last-child`);
        actionCell.html(`
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSpecialModal" data-item-id="${itemId}">Edit</button>
            <button class="btn btn-sm btn-outline-success" onclick="activateSpecial(${itemId})">Activate</button>
        `);
        
        // Show success message
        alert('Special menu item deactivated successfully!');
    }
}

// Function to activate special
function activateSpecial(itemId) {
    // Here you would normally make an AJAX call to activate the special
    console.log(`Activating special menu item ${itemId}`);
    
    // For demo purposes, update the UI directly
    $(`tr:has(button[onclick="activateSpecial(${itemId})"]) .badge`)
        .removeClass('bg-secondary')
        .addClass('bg-success')
        .text('Active');
    
    // Replace the activate button with deactivate button
    const actionCell = $(`tr:has(button[onclick="activateSpecial(${itemId})"]) td:last-child`);
    actionCell.html(`
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSpecialModal" data-item-id="${itemId}">Edit</button>
        <button class="btn btn-sm btn-outline-danger" onclick="deactivateSpecial(${itemId})">Deactivate</button>
    `);
    
    // Show success message
    alert('Special menu item activated successfully!');
}


(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
    
})(jQuery);

