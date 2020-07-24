/* eslint-disable */
$(document).ready(() => {
    $('#search_job_jobCategory').change(function () {
        const $field = $(this);
        const $data = {};
        $data.jobCategory = $field.val();
        $.post('/candidat/metier_rechercher', $data).done((data) => {
            const $select = $('#search_job_job');
            $select.empty();
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.text = 'Métier';
            $select.append(placeholder);
            for (let i = 0; i < data.length; i += 1) {
                const option = document.createElement('option');
                option.value = data[i].id;
                option.text = data[i].title;
                $select.append(option);
            }
        });
    });
});
