$(document).ready(function () {
    $('.match-detail').find('.btn-join').each(function () {
        $(this).click(function () {
            $('.match-detail').find('.btn-join').each(function () {
                $(this).removeClass('btn-selected');
            })
            $(this).addClass('btn-selected');
            if ($(this).hasClass('btn-join-left')) {
                if ($('.team-left ul').find('li.new').length == 0) {
                    $('.team-left ul').append("<li class='new'>Tran Tien Hiep</li>");
                    $('.team-right ul').find('li.new').remove();
                }

            }
            else {
                if ($('.team-right ul').find('li.new').length == 0) {
                    $('.team-right ul').append("<li class='new'>Tran Tien Hiep</li>");
                    $('.team-left ul').find('li.new').remove();
                }

            }
        })
    })

});