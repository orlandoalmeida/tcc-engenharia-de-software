window.msgDefault = function (title = '', msg = '') {
    Lobibox.notify('default', {
        sound: false,
        icon: false,
        size: 'mini',
        position: 'top right',
        title: title,
        msg: msg
    });
}
window.msgInfo = function (title = '', msg = '') {
    Lobibox.notify('info', {
        sound: false,
        icon: false,
        size: 'mini',
        position: 'top right',
        title: '<i class="fa fa-info-circle"></i> ' + title,
        msg: msg
    });
}
window.msgWarning = function (title = '', msg = '') {
    Lobibox.notify('warning', {
        sound: false,
        icon: false,
        position: 'top right',
        title: '<i class="fa fa-warning"></i> ' + title,
        msg: msg
    });
}
window.msgError = function (title = '', msg = '') {
    Lobibox.notify('error', {
        sound: false,
        icon: false,
        position: 'top right',
        title: '<i class="fa fa-times-circle"></i> ' + title,
        msg: msg
    });
}
window.msgSuccess = function (title = '', msg = '') {
    Lobibox.notify('success', {
        sound: false,
        icon: false,
        position: 'top right',
        title: '<i class="fa fa-check-circle"></i> ' + title,
        msg: msg
    });
}