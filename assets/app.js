// Small progressive enhancement: confirm before marking a listing sold.
document.querySelectorAll('form[action*="update-listing.php"]').forEach(form => {
  form.addEventListener('submit', event => {
    if (!confirm('Mark this listing as sold?')) event.preventDefault();
  });
});
