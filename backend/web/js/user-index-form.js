function toggleProfessionalFields() {
    var value = $('#user-type-dropdown').val();
    if (value == '1') { // TECNICO TRUE
        $('.professional-field').show();
    } else {
        $('.professional-field').hide();
    }
}

function updateStatusBadge() {
    const value = $('#user-status-dropdown').val();
    const badge = $('#user-status-badge');
    const statusMapping = {
        10: {text: 'ATIVO', class: 'bg-success'},
        9:  {text: 'INATIVO', class: 'bg-warning'},
        0:  {text: 'DESATIVADO', class: 'bg-danger'}
    };
    const status = statusMapping[value] || {text: 'DESCONHECIDO', class: 'bg-secondary'};
    badge.text(status.text);
    badge.removeClass('bg-success bg-warning bg-danger bg-secondary').addClass(status.class);
}
$(document).ready(function() {
    toggleProfessionalFields();
    updateStatusBadge();

    $('#user-type-dropdown').on('change', toggleProfessionalFields);
    $('#user-status-dropdown').on('change', updateStatusBadge);
});