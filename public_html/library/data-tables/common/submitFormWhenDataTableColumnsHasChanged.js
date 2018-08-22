function submitFormWhenDataTableColumnsHasChanged(form)
{
    $(document).on('click', '.ColVis_collectionBackground', function() {
        form.submit();
    });
}
