const deleteButtons = document.querySelectorAll('.deletion');

deleteButtons.forEach(button => {
  button.addEventListener('click', event => {
      event.preventDefault();
      const form = event.target.parentElement;
      confirmDeletion(form);
  })
})

function confirmDeletion(form) {
    swal({
        title: 'Are you sure you want to delete this?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal({
                    title: 'The deletion was cancelled.',
                    icon: 'info',
                    confirm: true,
                    timer: 3000,
                });
            }
        });
}
