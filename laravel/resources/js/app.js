import './bootstrap';
window.Echo.channel('book-rented')
    .listen('BookRentedEvent', (event) => {
        toastr.success(event.message);
    });