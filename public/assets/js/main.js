$(() => {
    $('.modal_window_hide').hide();
    $('.task_name_error').hide();
    $('.task_description_error').hide();
    $('.task_image_error').hide();
    $('.create_own_tag').hide();

    $(document).on('click', e => {
        const elem = e.target;
        if ($(elem).hasClass('modal_window_hide') ||
            $(elem).hasClass('confirm_denied') ||
            $(elem).hasClass('confirm_success')) {
            $('.modal_confirm').hide().removeClass('d-flex')
            $('.modal_window').hide().removeClass('d-flex')
            $('.modal_edit').hide().removeClass('d-flex')
        }
        if ($(elem).hasClass('tag_item')) {
            $('.tag_items').find('div').append($(elem))
        }
    })

    $('.create_new_task').on('click', e => {
        e.preventDefault();
        $('.modal_window').show().addClass('d-flex')
    })

    $('.add_new_task').on('click', e => {
        $('.task_name_error').hide();
        $('.task_description_error').hide();
        e.preventDefault();

        let $input = $("#task_image"),
            fd = new FormData,
            tags = [];
        $('.tag_item').map((index, item) => tags.push($(item).text()))

        fd.append('task_image', $input.prop('files')[0]);
        fd.append('task_name', $('#task_name').val());
        fd.append('task_description', $('#task_description').val());
        fd.append('task_tags', JSON.stringify(tags));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/create_new_task',
            method: 'post',
            data: fd,
            processData: false,
            contentType: false,
            success(response) {
                if (JSON.parse(response)['result'] === 'ok') {
                    $('.modal_window').hide().removeClass('d-flex');
                    location.reload();
                }
            },
            error(error) {
                const errors = JSON.parse(error.responseText).errors;
                Object.keys(JSON.parse(error.responseText).errors).forEach(item => {
                    $(`.${item}_error`).show().text(errors[item][0])
                })
            }
        })
    })

    $('#task_tags_input').on('keyup', () => {
        $('.tags_prepare_list').text('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/check_task_tags',
            method: 'get',
            data: {
                'tags': $('#task_tags_input').val()
            },
            dataType: "json",
            cache: false,
            crossDomain: false,
            success(response) {
                if (response.length === 0) {
                    $('.create_own_tag').show();
                    return;
                }
                $('.create_own_tag').hide();
                let issetIdElems = [];
                $('.tag_items').find('.tag_item').each((index, item) => {
                    issetIdElems.push($(item).data('id'))
                });
                Object.keys(response).slice(0, 7).forEach((item) => {
                    if (!issetIdElems.includes(+item)) {
                        $('.tags_prepare_list')
                            .append(`<span class="px-2 py-1 text-white bg-dark rounded mr-2 mb-2 tag_item" style="cursor: pointer" data-id="${item}">${response[item]}</span>`)
                    }
                })
            }
        })
    })

    $('.create_own_tag').on('click', e => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/new_tag_item',
            method: 'post',
            data: {
                'tag': $('#task_tags_input').val()
            },
            dataType: "json",
            cache: false,
            crossDomain: false,
            success(response) {
                $('.tag_items')
                    .find('div')
                    .append(`<span class="px-2 py-1 text-white bg-dark rounded mr-2 mb-2 tag_item" style="cursor: pointer" data-id="${response['id']}">${$('#task_tags_input').val()}</span>`)
            }
        })
    })

    $('.start_process_task').on('click', e => {
        e.preventDefault();
        $('.modal_confirm').show().addClass('d-flex')
        $('.confirm_success').on("click", e => {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/start_process_task',
                method: 'post',
                data: {
                    'task_id': $('.task_id').closest('.task_elem').find('.task_id').data('id')
                },
                dataType: "json",
                cache: false,
                crossDomain: false,
                success(response) {
                    if (response['result'] === 'ok') {
                        location.reload();
                    }
                }
            })
        })
    })

    $('.finish_process_task').on('click', e => {
        e.preventDefault();
        $('.modal_confirm').show().addClass('d-flex')
        $('.confirm_success').on("click", e => {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/finish_process_task',
                method: 'post',
                data: {
                    'task_id': $('.task_id').closest('.task_elem').find('.task_id').data('id')
                },
                dataType: "json",
                cache: false,
                crossDomain: false,
                success(response) {
                    console.log(response)
                    if (response['result'] === 'ok') {
                        location.reload();
                    }
                }
            })
        })
    })

    $('.edit_task').on('click', e => {
        e.preventDefault();
        $('.modal_edit').show().addClass('d-flex')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/edit_task_by_id',
            method: 'post',
            data: {
                'task_id': $('.task_id').data('id')
            },
            dataType: "json",
            cache: false,
            crossDomain: false,
            success(response) {
                console.log(response)
                if (response['result'] === 'ok') {
                    location.reload();
                }
            }
        })
    })
})
