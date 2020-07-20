$(document).ready(() => {
    $('#search_job_jobCategory').change(function () {
        const $field = $(this);
        const $data = {};
        $data[$field.attr('name')] = $field.val();
        $.post('/candidat/metier_rechercher', $data).done((data) => {
            console.log(data)
            const $input = $(data).find('#form_search_job');
            console.log($input)
            const $select = $('#form_search_job');
            console.log($select)
            $select.replaceWith($input);
        });
    });
});
