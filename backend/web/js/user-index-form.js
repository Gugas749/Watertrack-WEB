function toggleProfessionalFieldsDetails() {
    var value = $('#user-type-dropdown').val();
    if (value === '1') { // TECNICO
        $('.professional-field').removeClass('hidden');
    } else {
        $('.professional-field').addClass('hidden');
    }
}

function toggleProfessionalFieldsAdd() {
    var value1 = $('#create-user-type').val();
    if (value1 === '1') { // TECNICO
        $('#technician-extra').removeClass('hidden');
    } else {
        $('#technician-extra').addClass('hidden');
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
    toggleProfessionalFieldsDetails();
    toggleProfessionalFieldsAdd();
    updateStatusBadge();

    $('#user-type-dropdown').on('change', toggleProfessionalFieldsDetails);
    $('#create-user-type').on('change', toggleProfessionalFieldsAdd);
    $('#user-status-dropdown').on('change', updateStatusBadge);
});