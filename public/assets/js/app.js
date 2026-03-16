document.querySelectorAll('.delete-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!window.confirm('Ban co chac chan muon xoa user nay?')) {
            event.preventDefault();
        }
    });
});
